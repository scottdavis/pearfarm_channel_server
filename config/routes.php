<?php
/**
 * This File is ment for creating your routes
 * see: http://wiki.github.com/jetviper21/nimble/routing for more information
 * ex.
 * Route::resources("form");
 * R('')->controller('test')->action('index')->on('GET');
 */
R('')->controller('LandingController')->action('index')->on('GET');
R('/channel')->controller('ChannelController')->action('index')->on('GET');
R('/upload')->controller('ChannelController')->action('upload')->on('POST');
R('/upload')->controller('ChannelController')->action('add')->on('GET');
/** Catgories */
R('/rest/c/categories')->controller('RestController')->action('categories')->on('GET');
R('/rest/c/:name/info')->controller('RestController')->action('category_info')->on('GET');
R('/rest/c/:name/packages')->controller('RestController')->action('category_packages')->on('GET');
R('/rest/c/:name/packagesinfo')->controller('RestController')->action('packagesinfo')->on('GET');
/** Maintainers */
R('/rest/m/allmaintainers')->controller('RestController')->action('allmaintainers')->on('GET');
R('/rest/m/:name/info')->controller('RestController')->action('maintainer_info')->on('GET');
/** Packages */
R('/rest/p/packages')->controller('RestController')->action('packages')->on('GET');
R('/rest/p/:name/info')->controller('RestController')->action('package_info')->on('GET');
R('/rest/p/:name/maintainers')->controller('RestController')->action('package_maintainers')->on('GET');
R('/rest/p/:name/maintainers2')->controller('RestController')->action('package_maintainers2')->on('GET');
/** Releases */
R('/rest/r/:name/allreleases')->controller('RestController')->action('all_releases')->on('GET');
R('/rest/r/:name/allreleases2')->controller('RestController')->action('all_releases2')->on('GET');
R('/rest/r/:name/latest')->controller('RestController')->action('latest_release')->on('GET');
R('/rest/r/:name/stable')->controller('RestController')->action('stable_release')->on('GET');
R('/rest/r/:name/beta')->controller('RestController')->action('beta_release')->on('GET');
R('/rest/r/:name/alpha')->controller('RestController')->action('alpha_release')->on('GET');
R('/rest/r/:name/devel')->controller('RestController')->action('devel_release')->on('GET');
R('/rest/r/:name/(?P<version>[0-9]\.[0-9]\.[0-9])')->controller('RestController')->action('release_version')->on('GET');
R('/rest/r/:name/v2\.(?P<version>[0-9]\.[0-9]\.[0-9])')->controller('RestController')->action('release_version2')->on('GET');
R('/rest/r/:name/package\.(?P<version>[0-9]\.[0-9]\.[0-9])')->controller('RestController')->action('release_package_info')->on('GET');
R('/rest/r/:name/deps\.(?P<version>[0-9]\.[0-9]\.[0-9])')->controller('RestController')->action('release_dependencies')->on('GET');
R('/rest/r/:name\.(?P<version>[0-9]\.[0-9]\.[0-9])')->controller('RestController')->action('package_xml')->on('GET');
/** login routes */
R('/login')->controller('LoginController')->action('index')->on('GET');
R('/logout')->controller('LoginController')->action('logout')->on('GET');
R('/login')->controller('LoginController')->action('login')->on('POST');
R('/signup')->controller('LoginController')->action('add')->on('GET');
R('/signup')->controller('LoginController')->action('create')->on('POST');
R('/verify/:key')->controller('LoginController')->action('verify')->on('GET');
R('/login/checkuser')->controller('LoginController')->action('check_user')->on('POST');
R('/package/:name/(?P<version>[0-9]\.[0-9]\.[0-9])')->controller('VersionController')->action('show')->on('GET');
R('/package/:name')->controller('PackageController')->action('show')->on('GET');
?>