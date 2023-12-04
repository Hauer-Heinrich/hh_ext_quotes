# hh_ext_quotes
hh_ext_quotes is a TYPO3 extension.

### Installation
... like any other TYPO3 extension [extensions.typo3.org](https://extensions.typo3.org/ "TYPO3 Extension Repository")
Don't forget to include PageTS!

### Features
- disable inclusion of css files via Constant-Editor or TypoScript
- (optional) can be used with tt_address for "Authors"

### Events

| Event | $event->get[param] |
| ------ | ------ |
| StartQuoteListActionEvent | request, settings, assignedValues |
| EndQuoteListActionEvent | request, settings, quotes, paginator, pagination, assignedValues |

##### Event Usage Example:
// Configuration/Services.yaml
```
[VENDOR]\[ExtensionKey]\EventListener\[YourListener]:
    tags:
      - name: event.listener
        identifier: 'quotes-listener'
        method: '[YourMethod]'
        event: HauerHeinrich\HhExtQuotes\Event\StartQuoteListActionEvent
```
// Classes/EventListener/[YourListener].php
```
<?php
declare(strict_types=1);

namespace [Vendor]\[ExtensionKey]\EventListener;

use \HauerHeinrich\HhExtQuotes\Event\StartQuoteListActionEvent;

final class [YourListener] {

    public function [YourMethod](StartQuoteListActionEvent $event): void {
        // do your stuff
        $YourManipulatedSettings = $event->getSettings();
        $event->setSettings($YourManipulatedSettings);
    }
}
```

or see: [eventdispatcherquickstart](https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ApiOverview/Events/EventDispatcher/Index.html#eventdispatcherquickstart)

### IMPORTENT NOTICE

##### Copyright notice

This repository is part of the TYPO3 project. The TYPO3 project is
free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

The GNU General Public License can be found at
http://www.gnu.org/copyleft/gpl.html.

This repository is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

This copyright notice MUST APPEAR in all copies of the repository!

##### License
----
GNU GENERAL PUBLIC LICENSE Version 3
