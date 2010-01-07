##About

The pearfarm spce file is the interface for making a simple [package.xml](http://pear.php.net/manual/en/guide.developers.package2.php)


See the [Php Doc](http://fgrehm.github.com/pearfarm/pearfarm/Pearfarm_PackageSpec.html) for the spec class for more advanced information

###Default Options (required)
<br />

	->setName('PackageName')
	->setChannel('joe.pearfarm.org)
	->setSummary('Your short summary')
	->setDescription('More detailed information about your package')
	->setNotes('Release notes')
<br />	
###Release Options (required) 
<br />

	->setReleaseVersion('1.0.0')
	->setReleaseStability('alpha')
	
<br />	
###Api Options (required)  
<br />

	->setApiVersion('0.1.0')
	->setApiStability('alpha')
<br />	
###License Options (required) 
<br /> 
MIT is currently the only licenese defined as a constant
if you wish to add another type of license the format is as follows:
<br /><br />
<pre style='font-size:12px'>array('name' => 'MIT', 'uri' => 'http://www.opensource.org/licenses/mit-license.html')</pre></span>
<br />
Other wise just pass the constant
<br /><br />

	->setLicense(Pearfarm_PackageSpec::LICENSE_MIT)
	
<br />
###Maintainer options (required)  
Maintainers have 4 types

1. lead
2. developer
3. contributor
4. helper

Syntax:

	->addMaintainer(<type>, <name>, <username>, <email>)

<br />
###Repository options
Add all files from a git project

	->addGitFiles() 
Add all files from an svn project
	
	->addSvnFiles()

###Add a bunch of files from file system

Roles are:

1. php
2. data
3. script
4. test

Simple:

	->addFilesSimple($files, $role= self::ROLE_PHP, $options = array())
	
Regex:

	->addFilesRegex($regexs, $role = self::ROLE_PHP, $options = array())