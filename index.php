<?php

# Patchwork has to be imported first, as it will not work on any script
# compiled earlier than itself. See Limitations.

# If using Composer, import /vendor/antecedent/patchwork/Patchwork.php.

require '/vendor/antecedent/patchwork/Patchwork.php';
#require __DIR__ . '/patchwork.phar';
#require __DIR__ . '/pgsql_to_sqlite.php';

# No more code here: this file is also compiled earlier than Patchwork,
# so moving the contents of pgsql_to_sqlite.php here would make this fail.