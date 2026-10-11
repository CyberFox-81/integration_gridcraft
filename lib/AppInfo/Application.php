<?php

declare(strict_types=1);

/**
 * SPDX-FileCopyrightText: 2026 Britton Couchman <brittondcouchman@gmail.com>
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\GridCraftIntegration\AppInfo;

use OCA\Files\Event\LoadAdditionalScriptsEvent;
use OCA\GridCraftIntegration\Listener\LoadFilesScripts;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;

class Application extends App implements IBootstrap {
	public const APP_ID = 'integration_gridcraft';

	/** User and app config key: open workbooks in GridCraft when they are clicked in Files. */
	public const OPEN_BY_DEFAULT = 'open_by_default';

	/** The file types GridCraft opens: Excel, OpenDocument or CSV. Keep in sync with src/files.ts. */
	public const MIME_TYPES = [
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
		'application/vnd.ms-excel.sheet.macroEnabled.12',
		'application/vnd.ms-excel.template.macroEnabled.12',
		'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
		'application/vnd.oasis.opendocument.spreadsheet',
		'text/csv',
		'text/tab-separated-values',
	];

	/**
	 * Extensions GridCraft opens whatever MIME type Nextcloud gives them (formats Nextcloud doesn't
	 * know show up as application/octet-stream). Lower case, without the dot.
	 */
	public const EXTENSIONS = [
		'xlsx',
		'xltx',
		'xlsm',
		'xltm',
		'xlsb',
		'ods',
		'csv',
		'tsv',
	];

	/** Whether GridCraft opens a file with this name and MIME type. */
	public static function opens(string $name, string $mimeType): bool {
		return in_array($mimeType, self::MIME_TYPES, true)
			|| in_array(strtolower(pathinfo($name, PATHINFO_EXTENSION)), self::EXTENSIONS, true);
	}

	public function __construct() {
		parent::__construct(self::APP_ID);
	}

	public function register(IRegistrationContext $context): void {
		$context->registerEventListener(LoadAdditionalScriptsEvent::class, LoadFilesScripts::class);
	}

	public function boot(IBootContext $context): void {
	}
}
