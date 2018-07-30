 Show Once
=================

A Statamic V2 add-on to hide content from vistors after they've seen it. i.e. only show it to them once.

## Installing
1. Copy the "addons" folder contents to your Statamic `site` directory;
2. There is no step 2

## Usage

Wrap content you only want your visitors to see once in a `{{ show_once:foo }}` tag where `foo` should be unique and descriptive.

If the visitor is logged in to your site, the visibility status will persist across all devicers/browsers they are logged in with.

If they are not logged in, a cookie is used so they may see the content again if they view your site in a different browser/device.

While this add-on defaults to forever, you may also specify a time period (in minutes) by specifying a `per` argument like this: `{{ show_once:foo per="1440" }}`.

## LICENSE

[MIT License](http://emd.mit-license.org)
