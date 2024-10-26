<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Recordempleado Entity
 *
 * @property int $idRecord
 * @property int $idEmpleado
 * @property string $descripcion
 * @property bool $tipo_logro
 * @property \Cake\I18n\Date $fecha_ocurrencia
 */
class Recordempleado extends Entity
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
        'idEmpleado' => true,
        'descripcion' => true,
        'tipo_logro' => true,
        'fecha_ocurrencia' => true,
    ];
}
