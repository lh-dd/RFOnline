php_parser_v2

Updated version of trirozhka php parser.

- Updated to php 8
- Added 'precision_exporter.py'
	- Exports all tables with 1 click.
	- Keeps floating-point precision (no rounding down).
	- Adds a 'cache'.
	- Adds per-file export encoding option. (in config.ini, euc-kr ect)
	- Does not require office installed to export tables.

Requires Python:

pip install openpyxl