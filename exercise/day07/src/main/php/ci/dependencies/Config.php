<?php

namespace Ci\Dependencies;

interface Config {
    public function sendEmailSummary(): bool;
}