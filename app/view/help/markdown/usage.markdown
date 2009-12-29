#Usage Help

##PEAR Farm executable

The executable is a cli app that helps you achieve the goals of the project, namely package creation and distribution.

*Functions:*

<code>pearfarm init [specfilename=pearfarm.spec]</code>

creates a [pearfarm.spec](/help/spec) file that produces a package.

<code>pearfarm build</code>

creates a package.xml based on pearfarm.spec and builds the package .tgz file

<code>pearfarm push package.tgz</code>

pushes your package file to the server for distribution using inline authentication via ssh keys
pearfarm push pearfarm-0.1.0.tgz

<code>pearfarm keygen</code>

outputs a public key suitable for copy/paste into your pearfarm account.