<?php
$link = "https://accounts.zoho.com/oauth/v2/auth?scope=ZohoCRM.modules.all&amp;client_id=1000.YZO05BI18M18TAUKJGUA38BKMVNYKH&amp;response_type=code&amp;access_type=offline&amp;redirect_uri=http://zoho-api.sdk/zoho_redirect.php";

echo "<a href=\"$link\"> Authorise First Time </a>";