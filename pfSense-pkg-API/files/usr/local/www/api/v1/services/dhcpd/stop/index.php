<?php
# Copyright 2020 - Jared Hendrickson
# IMPORTS
require_once("apicalls.inc");

# RUN API CALL
$resp = api_services_dhcpd_stop();
http_response_code($resp["code"]);
echo json_encode($resp) . PHP_EOL;
exit();
