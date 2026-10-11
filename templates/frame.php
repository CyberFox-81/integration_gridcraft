<?php
/**
 * SPDX-FileCopyrightText: 2026 Britton Couchman <brittondcouchman@gmail.com>
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */
/** @var array $_ */
?>
<!DOCTYPE html>
<html lang="<?php p($_['language']); ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="robots" content="noindex, nofollow">
	<title>GridCraft</title>
	<style>
		html, body { margin: 0; padding: 0; width: 100%; height: 100%; overflow: hidden; background: #f3f3f3; }
		#gridcraft_canvas { position: absolute; inset: 0; width: 100%; height: 100%; display: block; }
		#gridcraft_loading { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; pointer-events: none; }
		@media (prefers-color-scheme: dark) { html, body { background: #292929; } }
	</style>
</head>
<body>
	<canvas id="gridcraft_canvas"></canvas>
	<div id="gridcraft_loading"></div>
	<?php emit_script_tag($_['bootUrl'], '', 'module'); ?>
</body>
</html>
