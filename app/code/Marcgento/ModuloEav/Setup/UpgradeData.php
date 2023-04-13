<?php


namespace Marcgento\ModuloEav\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $departamentoFactory;
    protected $empleadosFactory;

    public function __construct(
        \Marcgento\ModuloEav\Model\DepartamentoFactory $departamentoFactory,
        \Marcgento\ModuloEav\Model\EmpleadosFactory $empleadosFactory
    ){
        $this->departamentoFactory = $departamentoFactory;
        $this->empleadosFactory = $empleadosFactory;
    }

    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ){
        $setup->startSetup();
        /* Departamento Sales */
        $salesDept = $this->departamentoFactory->create();
        $salesDept->setName('Sales');
        $salesDept->save();
        /* Empleado 1 */
        $empleado1 = $this->empleadosFactory->create();
        $empleado1->setDepartmentId($salesDept->getId());
        $empleado1->setEmail('luualamillo@gmail.com');
        $empleado1->setFirstName('Luis');
        $empleado1->setLastName('Alamillo');
        $empleado1->setServiceYears(3);
        $empleado1->setDob('1989-10-02');
        $empleado1->setSalary(3800.00);
        $empleado1->setVatNumber('5899');
        $empleado1->setNote('Esto es una nota aleatoria');
        $empleado1->save();

        /* Departamento Finance */
        $financeDept = $this->departamentoFactory->create();
        $financeDept->setName('Finance');
        $financeDept->save();

        /* Empleado 2 */
        $empleado2 = $this->empleadosFactory->create();
        $empleado2->setDepartmentId($financeDept->getId());
        $empleado2->setEmail('mas@gmail.com');
        $empleado2->setFirstName('Luis2');
        $empleado2->setLastName('Alamillo2');
        $empleado2->setServiceYears(2);
        $empleado2->setDob('1989-11-04');
        $empleado2->setSalary(4000.00);
        $empleado2->setVatNumber('4478');
        $empleado2->setNote('Segunda nota');
        $empleado2->save();

        $setup->endSetup();
    }
}