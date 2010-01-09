##Is this site supposed to replace pear.php.net? 
This site is meant to replace pear.php.net's packages hosting service. And we are still working on it.
 
##Why is this better than pear.php.net package hosting? 
The acceptance process of pear packages is too slow and strict. In pearfarm we think different, we believe that the community will decide which packages are good or not. And we don't like to restrict the way you write your packages with specific coding styles, etc. Although we encourage good and understandable code so we can all be happy!
 
##How can the process for publishing a pear package get any easier? 
Through one command: `pearfarm push somepackage-0.0.0.tar.gz`.
 
##Can anyone push to any package?
No. For new packages, once you push them you automatically gain control over it. For existing packages, you need to be the owner to push to them.
 
##How can I offer a package in pearfarm.org that I already offer through pear.php.net?
You should just include a spec file in your code, build the package and push it. In the near future a way to convert package.xml files to spec files will be available.
 
##Will the package installation process change?
No. Just add the pearfarm channel and pear install the packages that you like.
 
##How can I help?
Fork away on GitHub and make your changes!