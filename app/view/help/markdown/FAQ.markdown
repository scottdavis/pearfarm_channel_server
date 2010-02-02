##Is this site supposed to replace pear.php.net? 
Thats is up to the community to decided we are just here to offer easy to use pear hosting!

<br />
##Why is this better than pear.php.net package hosting? 
The acceptance process of pear packages is too slow and strict. In pearfarm we think different, we believe that the community will decide which packages are good or not. And we don't like to restrict the way you write your packages with specific coding styles, etc. Although we encourage good and understandable code so we can all be happy!

<br />
##Why does each person have their own channel as opposed to a global channel

1. It improves performance of the pear installation as pearfarm gets tons of packages.
2. It allows for multiple forks of the same project to be easily hosted inside of pearfarm with very little confusion. 

<br />
##How can the process for publishing a pear package get any easier? 
Through one command: `pearfarm push`.
 
<br />
##Can anyone push to any package?
No. For new packages, once you push them you automatically gain control over it. For existing packages, you need to be the owner to push to them.

<br />
##How can I offer a package in pearfarm.org that I already offer through pear.php.net?
You should just include a spec file in your code, build the package and push it. In the near future a way to convert package.xml files to spec files will be available.

<br />
##Will the package installation process change?
No. Just add the pearfarm channel and pear install the packages that you like.

<br />
##How can I help?
Fork away on GitHub and make your changes!