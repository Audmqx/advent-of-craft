<?php

namespace Ci\Dependencies;

enum TestStatus {
    case NO_TESTS;
    case PASSING_TESTS;
    case FAILING_TESTS;
}
