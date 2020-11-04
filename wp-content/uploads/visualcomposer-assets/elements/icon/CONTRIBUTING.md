# Contributing to Visual Composer Premium element

## Creating an element

Check this [link](https://office.visualcomposer.com/docs/developers/creating-an-element/).

## Submission Guidelines

### Forking workflow
Keep the `master` branch tests passing at all times.

If you send a pull request, please do it against the master branch. We maintain stable branches for major versions separately (Example: `12.x`). Instead of accepting pull requests to the version branches directly, we cherry-pick non-breaking changes from `master` to the version.

Make fork for of VCWB element repo in Gitlab. Go to your active WordPress `wp-content/plugins/{vcwb}/devElements` directory.

```sh
$ git clone git@gitlab.com/<Username>/{element-tag}.git
$ cd ${element-tag}
$ git remote add upstream git@gitlab.com:visualcomposer-hub/{element-tag}.git
$ git remote set-url --push upstream no_push
$ git remote -v
origin	git@gitlab.com:<Username>/{element-tag}.git (fetch)
origin	git@gitlab.com:<Username>/{element-tag}.git (push)
upstream	git@gitlab.com:visualcomposer-hub/{element-tag}.git (fetch)
upstream	no_push (push)
```

### Creating features
Use [Feature Branch workflow](https://es.atlassian.com/git/tutorials/comparing-workflows/feature-branch-workflow). If you want to send you data to upstream you need to [create pull request in GitHub](https://help.github.com/en/articles/creating-a-pull-request-from-a-fork).

```sh
$ git checkout -b <VC-ID-feature-branch-in-kebab-case>
# Edit some code
$ git commit -m "Message for change [VC-ID]"
$ git push -u origin <feature-branch-in-kebab-case VC-ID>
```

### Bring builder up to date
```sh
$ git checkout master && git pull upstream master # checkout
$ git push
```

### Cleanup after pull request
```sh
$ git branch -d <branch name>
$ git push origin master
```
