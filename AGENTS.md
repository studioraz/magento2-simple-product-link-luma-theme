<!-- FOR AI AGENTS - Human readability is a side effect, not a goal -->
<!-- Managed by agent: keep sections and order; edit content, not structure -->
<!-- Last updated: 2026-08-03 | Last verified: 2026-08-03 -->

# AGENTS.md — SR_SimpleProductLinkLumaTheme
> Standalone module for Magento 2.4 · namespace `SR\SimpleProductLinkLumaTheme` · PHP ≥8.1 · Luma/Blank frontend

**Precedence:** the **closest `AGENTS.md`** to the files you're changing wins. Root holds global defaults only.

## Commands
| Task | Command |
|------|---------|
| Enable | `ddev magento module:enable SR_SimpleProductLinkLumaTheme` |
| Upgrade | `ddev magento setup:upgrade` |
| Test | `composer test` |
| Flush FPC | `ddev magento cache:flush full_page` |

## File Map
```text
src/Api/, src/Model/                       → rule API and business logic
src/Controller/, src/Ui/, src/view/adminhtml/ → admin rule management
src/Setup/Patch/Data/                      → simple_product_group attribute
src/Block/, src/ViewModel/                 → PDP data and cache tags
src/view/frontend/layout/                  → Luma PDP placement
src/view/frontend/templates/, web/css/     → Luma BEM markup and LESS
tests/Unit/                                 → PHPUnit tests
```

## Rules
- Use module ID `SR_SimpleProductLinkLumaTheme` and namespace `SR\SimpleProductLinkLumaTheme`.
- Keep Blocks thin; assemble storefront data in `src/ViewModel/LinkedProducts.php`.
- Create product attributes through data patches, never raw SQL.
- Keep Luma styles in `_module.less` using Magento UI variables.
- Preserve variation sort order and group cache tags.
- Run PHP/XML checks and the unit suite before completion.

## Boundaries
- Ask before adding dependencies, changing public APIs, or changing `simple_product_group` storage.
- Never use ObjectManager fallbacks, bypass ACL, or modify Magento core files.

## Codebase State
- Standalone Luma package with no dependency on `studioraz/magento2-simple-product-link`.
- Original business identifiers and DB table names are retained for data compatibility.
- Frontend uses layout XML, PHTML, Swatches APIs, and LESS; there is no JS bundle.
- PHPUnit 11 is declared; Magento project dependencies may emit PHP-version deprecations.

## When instructions conflict
The nearest `AGENTS.md` wins. Explicit user prompts override files.
