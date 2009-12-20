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
	/** Catgories */
	R('/c/categories')->controller('RestController')->action('categories')->on('GET');
	R('/c/categories/:name/info')->controller('RestController')->action('category_info')->on('GET');
	R('/c/categories/:name/packages')->controller('RestController')->action('category_packages')->on('GET');
	R('/c/categories/:name/packagesinfo')->controller('RestController')->action('packagesinfo')->on('GET');
	/** Maintainers */
	R('/m/allmaintainers')->controller('RestController')->action('allmaintainers')->on('GET');
	R('/m/:name/info')->controller('RestController')->action('maintainer_info')->on('GET');
	/** Packages */
	R('/p/packages')->controller('RestController')->action('packages')->on('GET');
	R('/p/:name/info')->controller('RestController')->action('package_info')->on('GET');
	R('/p/:name/maintainers')->controller('RestController')->action('package_maintainers')->on('GET');
	R('/p/:name/maintainers2')->controller('RestController')->action('package_developers')->on('GET');
	/** Releases */
	R('/r/:name/allreleases')->controller('RestController')->action('all_releases')->on('GET');
	R('/r/:name/allreleases2')->controller('RestController')->action('all_releases2')->on('GET');
	R('/r/:name/latest')->controller('RestController')->action('latest_releases')->on('GET');
	R('/r/:name/stable')->controller('RestController')->action('stable_releases')->on('GET');
	R('/r/:name/beta')->controller('RestController')->action('beta_releases')->on('GET');
	R('/r/:name/alpha')->controller('RestController')->action('alpha_releases')->on('GET');
	R('/r/:name/devel')->controller('RestController')->action('devel_releases')->on('GET');
	R('/r/:name/(?P<version>[0-9]\.[0-9]\.[0-9])')->controller('RestController')->action('release_version')->on('GET');
	R('/r/:name/v2(?P<version>\.[0-9]\.[0-9]\.[0-9])')->controller('RestController')->action('release_versions')->on('GET');
	R('/r/:name/package(?P<version>\.[0-9]\.[0-9]\.[0-9])')->controller('RestController')->action('release_package_info')->on('GET');
	R('/r/:name/deps(?P<version>\.[0-9]\.[0-9]\.[0-9])')->controller('RestController')->action('release_dependencies')->on('GET');
?>