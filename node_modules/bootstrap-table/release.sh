#!/bin/bash

set -ex

target_version=$1
current_version=`node -e "console.log(require('./package').version)"`
version_start=`echo $current_version | cut -d '.' -f 1-2`

echo "Current version: $current_version"

build_docs () {
  # target version not start with current version
  if [[ ! $1 == $version_start* ]]; then
    echo "Building docs: $current_version"
    git checkout master
    git pull
    yarn docs
    mv _gh_pages $current_version
    git checkout gh-pages
    git pull
    mv $current_version versions/
    git add versions/$current_version
    git commit -m "Add $current_version"
    git push
  fi
}

update_version () {
  echo "Updating version: $target_version"
  git checkout develop
  git pull
  node tools/release.js $target_version $version_start
}

build_dist () {
  echo "Building dist"
  yarn build
  git add dist
  git commit -a -m "Build $target_version"
  git push
}

merge_develop () {
  echo "Merging develop to master"
  git checkout master
  git pull
  git merge develop
  git push -u origin master
}

add_tag () {
  echo "Adding tag: $target_version"
  git tag $target_version
  git push --tags
}

npm_publish () {
  echo "NPM publishing"
  npm publish --registry=https://registry.npmjs.org
}

update_algolia_and_live () {
  echo "Updating algolia and bootstrap-table-live"
  ALGOLIA_API_KEY='94b423a877c9386f44876be39c7ace24' bundle exec jekyll algolia

  cd tools
  node get-extensions-list.js
  cd ..
}

replace_version () {
  sed -i '' -e "s/version\": \"$current_version/version\": \"$target_version/g" $1
}

replace_npm_version () {
  sed -i '' -e "s/bootstrap-table\": \"^$current_version/bootstrap-table\": \"^$target_version/g" $1
}

replace_cdn_version () {
  sed -i '' -e "s/bootstrap-table@$current_version/bootstrap-table@$target_version/g" $1
}

update_bootstrap_table_examples () {
  echo "Updating bootstrap-table-examples"
  cd ../bootstrap-table-examples
  git checkout develop
  git pull

  replace_version package.json
  replace_npm_version vue-starter/package.json
  replace_npm_version webpack-starter/package.json
  replace_cdn_version welcome.html
  replace_cdn_version assets/js/template.js
  replace_cdn_version crud/index.html
  replace_cdn_version options/table-locale.html
  replace_cdn_version welcomes/vue-component.html

  git commit -a -m "Build $target_version"

  merge_develop

  cd tools
  node algolia.js
  node data.js

  cd ../../bootstrap-table
}

update_bootstrap_table_live () {
  echo "Updating bootstrap-table-live"
  cd ../bootstrap-table-live
  node tools/release.js $target_version
  git commit -a -m "Add $target_version"
  git pull --rebase
  git push

  cd static
  ./deploy.sh
  cd ../../bootstrap-table
}

# build_docs
# update_version
# build_dist
# merge_develop
# add_tag
npm_publish
update_algolia_and_live
update_bootstrap_table_examples
update_bootstrap_table_live
