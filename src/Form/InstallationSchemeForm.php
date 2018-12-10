<?php
/**
 * Created by PhpStorm.
 * User: dii
 * Date: 10.12.18
 * Time: 17:16
 */

namespace Form;

use Core\Request\Request;
use Model\InstallationSchemeModel;

class InstallationSchemeForm
{
    private $data;
    private $violations = [];
    private $userModel;

    /**
     * UserForm constructor.
     * @param InstallationSchemeModel $schemeModel
     * @param array $scheme
     */
    public function __construct(InstallationSchemeModel $schemeModel, array $data = [])
    {
        $this->schemeModel = $schemeModel;
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getViolations(): array
    {
        return $this->violations;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function isValid()
    {
        return count($this->violations) === 0;
    }
}