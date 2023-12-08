<?php

use PHPUnit\Framework\TestCase;
use Main\PasswordValidator;
/**
    The password verification program will take a password as an argument and
    the password will be valid only if all these conditions are correct:

    - Contains at least 8 characters
    - Contains at least one capital letter
    - Contains at least one lowercase letter
    - Contains at least a number
    - Contains at least a special character in this list `. * # @ $ % &`.
    - Any other characters are not authorized.

    In this program, the only thing that matters is to know if the password is valid.
    Not why it is not.
 */

class AuthenticationPasswordValidationTest extends TestCase
{
    public function test_password_should_be_at_least_eight_characters(): void
    {
        $input = "jesuisunmotdepasse";

        $password = new PasswordValidator($input);

        $this->assertTrue($password->isLongEnough());
    }

    public function test_password_should_have_at_least_one_capital_letter(): void
    {
        $input = "jesuisunmotdepAsse";

        $password = new PasswordValidator($input);

        $this->assertTrue($password->isHavingCapitals());
    }

    public function test_password_should_have_at_least_one_lowercase_letter(): void
    {
        $input = "jesuisunmotdepAsse";

        $password = new PasswordValidator($input);

        $this->assertTrue($password->isHavinglowercase());
    }

    public function test_password_should_have_at_least_one_number(): void
    {
        $input = "jesuisun5motdepAsse";

        $password = new PasswordValidator($input);

        $this->assertTrue($password->isHavingNumber());
    }
}