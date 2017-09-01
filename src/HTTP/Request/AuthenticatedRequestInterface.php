<?php
/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 30.08.2017
 * Time: 16:54
 */

namespace Mattwoo\IsystemsClient\HTTP\Request;

interface AuthenticatedRequestInterface
{
    public function getCredentials(): UserCredentials;
}
