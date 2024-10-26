<?php
declare(strict_types=1);

namespace App\Model\Entity;
use Cake\ORM\Entity;

/**
 * Empleado Entity
 *
 * @property int $idEmpleado
 * @property int $idPuesto
 * @property int $idTienda
 * @property string $nombres
 * @property string $apellidos
 * @property \Cake\I18n\Date $fecha_nacimiento
 * @property string|resource|null $fotografia
 * @property string $salario
 */
class Empleado extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'idPuesto' => true,
        'idTienda' => true,
        'nombres' => true,
        'apellidos' => true,
        'fecha_nacimiento' => true,
        'fotografia' => true,
        'salario' => true,
    ];
}
