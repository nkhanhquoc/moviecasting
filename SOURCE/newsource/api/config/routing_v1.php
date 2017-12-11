<?php

return [
    'v1/authorization-code/<client_id>/<client_secret>' => 'v1/authorization/get-authorization-code',
    'v1/<controller:\w+>/<action:\w+>' => 'v1/<controller>/<action>',
];
