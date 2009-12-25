<?xml version="1.0" encoding="iso-8859-1"?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
<ShortName>Pearfarm</ShortName>
<Description>Pearfarm Search</Description>
<Url type="text/html" method="get" template="http://<?php echo DOMAIN ?>/search/{searchTerms}"/>
<Url type="application/x-suggestions+json" method="get" template="http://<?php echo DOMAIN ?>/search/{searchTerms}.json"/>
<Image height="16" width="16" type="image/x-icon">http://<?php echo DOMAIN ?>/public/image/favico.ico</Image>
</OpenSearchDescription>