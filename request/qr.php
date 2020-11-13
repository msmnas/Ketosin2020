<?php

include 'phpqrcode/phpqrcode.php';

QRcode::png('PHP QR Code :)', 'asem3.png', QR_ECLEVEL_H, 10);