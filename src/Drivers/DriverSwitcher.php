<?php

namespace SergiX44\ImageZen\Drivers;

use RuntimeException;
use SergiX44\ImageZen\Backend;
use SergiX44\ImageZen\Format;

trait DriverSwitcher
{
    public function switchTo(Backend $backend): self
    {
        if ($this->backend === $backend) {
            return $this;
        }

        $newDriver = $backend->getDriver();

        if (!$newDriver->isAvailable()) {
            throw new RuntimeException('The selected backend not available.');
        }

        $data = $this->driver->getStream($this, Format::PNG, 100)->getContents();
        array_map(fn ($snapshot) => $this->driver->clear(raw: $snapshot), $this->snapshots);

        $this->snapshots = [];
        $this->image = $newDriver->loadImageFrom($data);
        $this->driver = $newDriver;
        $this->backend = $backend;

        return $this;
    }
}
