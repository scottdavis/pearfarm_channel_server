###Creating a new spec
	pearfarm init
		
###Default Options
`->setName('PackageName')`  
`->setChannel('joe.pearfarm.org)`  
`->setSummary('Your short summary')`  
`->setDescription('More detailed information about your package')`	
`->setNotes('Release notes')`	
`->setReleaseVersion('1.0.0')`	
`->setReleaseStability('alpha')`	
`->setApiVersion('0.1.0')`	
`->setApiStability('alpha')`	
`->setLicense(Pearfarm_PackageSpec::LICENSE_MIT)`	
`->addMaintainer('lead', 'Alan Pinstein', 'apinstein', 'apinstein@mac.com')`	



###dd
	<?php
 
	$spec = Pearfarm_PackageSpec::create(array(
					Pearfarm_PackageSpec::OPT_BASEDIR => dirname(__FILE__),
					Pearfarm_PackageSpec::OPT_DEBUG => true )
					)
    ->setName('pearfarm')
    ->setChannel('apinstein.dev.pearfarm.org')
    ->setSummary('Build and distribute PEAR packages easily.')
    ->setDescription('Pearfarm makes it easy to create PEAR packages.')
    ->setNotes('See http://github.com/fgrehm/pearfarm for changelog, docs, etc.')
    ->setReleaseVersion('0.1.2')
    ->setReleaseStability('alpha')
    ->setApiVersion('0.1.0')
    ->setApiStability('alpha')
    ->setLicense(Pearfarm_PackageSpec::LICENSE_MIT)
    ->addMaintainer('lead', 'Alan Pinstein', 'apinstein', 'apinstein@mac.com')
    ->addMaintainer('lead', 'Fabio Rehm', 'fgrehm', 'fgrehm@gmail.com')
    ->addMaintainer('lead', 'Jonathan Leibiusky', 'xetorthio', 'ionathan@gmail.com')
    ->addMaintainer('lead', 'Scott Davis', 'jetviper21', 'jetviper21@gmail.com ')
    ->addFilesRegex(array('/src/', '/pearfarm$/'))
    ->addFilesRegex('/test/', 'test')
    ->addFilesRegex('/^README.markdown/', 'doc')
    ->addExcludeFilesRegex(array('/\.git/'))
    ->addExcludeFiles(array('.gitignore', 'pearfarm.spec'))
    ->addExecutable('pearfarm')
    ;