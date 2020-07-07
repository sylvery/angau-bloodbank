<?php

namespace App\AppBundle\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(['class' => 'navbar-nav mr-auto mt-2 mt-lg-0']);
        $menu->addChild('Home', [
            'route' => 'home',
            'linkAttributes'=> [
                'class'=> 'nav-link',
            ],
            'attributes'=> [
                'class'=> 'nav-item',
            ],
        ]);
        $donation = $menu->addChild('Donation', [
            'label' => 'Donation',
            'childrenAttributes'=> [
                'class'=> 'dropdown-menu bg-warning',
                'id'=> 'donationDropdownTrigger',
            ],
            'attributes'=> [
                'class'=> 'dropdown',
            ],
            'labelAttributes'=> [
                'class'=> 'dropdown-toggle btn btn-secondary',
                'type' => 'button',
                'data-target'=> '#donationDropdownTrigger',
                'data-toggle' => 'dropdown',
                'aria-haspopup' => 'true',
                'aria-expanded' => 'false',
            ],
        ]);
        $donation->addChild('Donations', [
            'route' => 'donation_index',
            'linkAttributes'=> [ 'class'=> 'dropdown-item btn btn-warning'],
        ]);
        $donation->addChild('Bloodbags', [
            'route' => 'bloodbag_index',
            'linkAttributes'=> [ 'class'=> 'dropdown-item btn btn-warning'],
        ]);
        $donation->addChild('Bloodtests', [
            'route' => 'bloodtest_index',
            'linkAttributes'=> [ 'class'=> 'dropdown-item btn btn-warning'],
        ]);
        $donation->addChild('Locations', [
            'route' => 'location_index',
            'linkAttributes'=> [ 'class'=> 'dropdown-item btn btn-warning'],
        ]);
        $donation->addChild('Sicktypes', [
            'route' => 'sicktype_index',
            'linkAttributes'=> [ 'class'=> 'dropdown-item btn btn-warning'],
        ]);
        $menu->addChild('Donors', [
            'route' => 'donor_index',
            'linkAttributes'=> [
                'class'=> 'nav-link',
            ],
            'attributes'=> [
                'class'=> 'nav-item',
            ],
        ]);
        $menu->addChild('Employee', [
            'route' => 'employee_index',
            'linkAttributes'=> [
                'class'=> 'nav-link',
            ],
            'attributes'=> [
                'class'=> 'nav-item',
            ],
        ]);
        return $menu;
    }
}
