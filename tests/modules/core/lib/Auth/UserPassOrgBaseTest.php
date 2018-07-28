<?php

namespace SimpleSAML\Test\Module\core\Auth;

use SimpleSAML\Module\core\Auth\UserPassOrgBase;

class UserPassOrgBaseTest extends \PHPUnit_Framework_TestCase
{
    public function testRememberOrganizationEnabled()
    {
        $config = array(
            'ldap:LDAPMulti',

            'remember.organization.enabled' => true,
            'remember.organization.checked' => false,

            'my-org' => array(
                'description' => 'My organization',
                // The rest of the options are the same as those available for
                // the LDAP authentication source.
                'hostname' => 'ldap://ldap.myorg.com',
                'dnpattern' => 'uid=%username%,ou=employees,dc=example,dc=org',
                // Whether SSL/TLS should be used when contacting the LDAP server.
                'enable_tls' => false,
            )
        );

        // When PHP 5.4 support is dropped, replace with:
        // $mockUserPassOrgBase = $this->getMockBuilder(\SimpleSAML\Module\core\Auth\UserPassOrgBase::class)
        $mockUserPassOrgBase = $this->getMockBuilder(get_parent_class(new \SimpleSAML\Module\ldap\Auth\Source\LDAPMulti(array('AuthId' => 'my-org'), array())))
            ->setConstructorArgs(array(array('AuthId' => 'my-org'), &$config))
            ->setMethods(array())
            ->getMockForAbstractClass();

        $this->assertTrue($mockUserPassOrgBase->getRememberOrganizationEnabled());
    }
}
