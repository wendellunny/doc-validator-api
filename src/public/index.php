<?php
/**
 * Document formatting and validation API
 * 
 * @author wendellunny
 */

require __DIR__ 
. DIRECTORY_SEPARATOR 
. '..'
. DIRECTORY_SEPARATOR
. 'vendor'
. DIRECTORY_SEPARATOR
. 'autoload.php';

$cnpjFormatterControllerFactory = new \App\Factories\Controllers\Cnpj\CnpjFormatterFactory();
$cnpjValidatorControllerFactory = new \App\Factories\Controllers\Cnpj\CnpjValidatorFactory();
$cnpjFactory = new \App\Factories\Models\CnpjFactory();

$cpfFormatterControllerFactory = new \App\Factories\Controllers\Cpf\CpfFormatterFactory();
$cpfValidatorControllerFactory = new \App\Factories\Controllers\Cpf\CpfValidatorFactory();
$cpfFactory = new \App\Factories\Models\CpfFactory();

$routerSwitch = new \App\Routes\RouterSwitch(
    $cnpjFormatterControllerFactory,
    $cnpjValidatorControllerFactory,
    $cnpjFactory,
    $cpfFormatterControllerFactory,
    $cpfValidatorControllerFactory,
    $cpfFactory
);
$router = new \App\Routes\Router();

if (!$routerSwitch->execute($router)) {
    echo json(['message' => 'Endpoint não encontrado'], 404);
}
die();