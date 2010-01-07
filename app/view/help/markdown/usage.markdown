##PEAR Farm executable

A cli application that helps you achieve the goals of the project, namely package creation and distribution.

###*Functions:*
<br />
`pearfarm init`
<br /><br />
Creates a [pearfarm.spec](/help/spec) file that produces a package.
<br /><br />
`pearfarm build`
<br /><br />
Creates a package.xml based on pearfarm.spec and builds the package .tgz file
<br /><br />
`pearfarm keygen`
<br /><br />
Outputs a public key suitable for copy/paste into your pearfarm account.
<br /><br />
`pearfarm push package.tgz`
<br /><br />
Pushes your package file to the server for distribution using inline authentication via openssl keys
pearfarm push pearfarm-0.1.0.tgz
<br /><br />
