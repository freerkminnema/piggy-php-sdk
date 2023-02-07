<?php

namespace Piggy\Api\Tests\OAuth\ContactAttributes;

use Piggy\Api\Exceptions\PiggyRequestException;
use Piggy\Api\Tests\OAuthTestCase;


class ContactAttributesResourceTest extends OAuthTestCase
{
    /** @test
     * @throws PiggyRequestException
     */
    public function it_returns_a_list_of_contact_attributes()
    {
        $this->addExpectedResponse([
            [
                "name" => "asdf",
                "label" => "some_label",
                "type" => "text",
                "field_type" => "text",
                "description" => null,
                "is_soft_read_only" => false,
                "is_hard_read_only" => false,
                "is_piggy_defined" => true,
                "options" => []
            ]
        ]);

        $contactAttributes = $this->mockedClient->contactAttributes->list();

        $this->assertEquals("asdf", $contactAttributes[0]->getName());
        $this->assertEquals("some_label", $contactAttributes[0]->getLabel());
        $this->assertEquals("text", $contactAttributes[0]->getType());
        $this->assertEquals("text", $contactAttributes[0]->getFieldType());
        $this->assertEquals(null, $contactAttributes[0]->getDescription());
        $this->assertEquals(false, $contactAttributes[0]->getIsSoftReadOnly());
        $this->assertEquals(false, $contactAttributes[0]->getIsHardReadOnly());
        $this->assertEquals(true, $contactAttributes[0]->getIsPiggyDefined());
        $this->assertEquals([], $contactAttributes[0]->getOptions());

    }

    /** @test
     * @throws PiggyRequestException
     */
    public function it_returns_a_list_of_contact_attributes_with_options()
    {
        $this->addExpectedResponse([
            [
                "name" => "another_first_name",
                "label" => "another_label",
                "type" => "select",
                "field_type" => "select",
                "description" => "another_description",
                "is_soft_read_only" => true,
                "is_hard_read_only" => true,
                "is_piggy_defined" => false,
                "options" =>
                    [
                        ["label" => "some_option_label", "value" => "3"],
                        ["label" => 'some_second_option_label', "value" => "4"]
                    ]
            ],
        ]);

        $contactAttributes = $this->mockedClient->contactAttributes->list();

        $this->assertEquals("another_first_name", $contactAttributes[0]->getName());
        $this->assertEquals("another_label", $contactAttributes[0]->getLabel());
        $this->assertEquals("select", $contactAttributes[0]->getType());
        $this->assertEquals("select", $contactAttributes[0]->getFieldType());
        $this->assertEquals("another_description", $contactAttributes[0]->getDescription());
        $this->assertEquals(true, $contactAttributes[0]->getIsSoftReadOnly());
        $this->assertEquals(true, $contactAttributes[0]->getIsHardReadOnly());
        $this->assertEquals(false, $contactAttributes[0]->getIsPiggyDefined());

        $this->assertEquals('some_option_label', $contactAttributes[0]->getOptions()[0]['label']);
        $this->assertEquals('3', $contactAttributes[0]->getOptions()[0]['value']);

        $this->assertEquals('some_second_option_label', $contactAttributes[0]->getOptions()[1]['label']);
        $this->assertEquals('4', $contactAttributes[0]->getOptions()[1]['value']);



    }

    /** @test
     * @throws PiggyRequestException
     */
    public function it_creates_a_simple_contact_attribute()
    {
        $this->addExpectedResponse(
            [
                "name" => "some_name",
                "label" => "some_label",
                "type" => "url",
                "field_type" => "text",
                "description" => null,
                "options" => []
            ]
        );

        $contactAttribute = $this->mockedClient->contactAttributes->create('some_name', 'some_label', 'url');

        $this->assertEquals("some_name", $contactAttribute->getName());
        $this->assertEquals("some_label", $contactAttribute->getLabel());
        $this->assertEquals("url", $contactAttribute->getType());
        $this->assertEquals("text", $contactAttribute->getFieldType());
        $this->assertEquals(null, $contactAttribute->getDescription());
        $this->assertEquals([], $contactAttribute->getOptions());

    }

    /** @test
     * @throws PiggyRequestException
     */
    public function it_creates_a_phone_number_contact_attribute()
    {

        $this->addExpectedResponse(
            [
                "name" => "some_phone_number",
                "label" => "some_label_for_phone_number",
                "type" => "phone",
                "description" => 'some_description',
                "options" => []
            ]
        );

        $contactAttribute = $this->mockedClient->contactAttributes->create('some_phone_number', 'some_label_for_phone_number', 'phone');

        $this->assertEquals("some_phone_number", $contactAttribute->getName());
        $this->assertEquals("some_label_for_phone_number", $contactAttribute->getLabel());
        $this->assertEquals("phone", $contactAttribute->getType());
        $this->assertEquals("some_description", $contactAttribute->getDescription());
        $this->assertEquals([], $contactAttribute->getOptions());

    }

    /** @test
     * @throws PiggyRequestException
     */
    public function it_creates_a_license_plate_contact_attribute()
    {
        $this->addExpectedResponse(
            [
                "name" => "henkie_name",
                "label" => "henkie_label",
                "type" => "license_plate",
                "description" => 'henkie_description',
                "options" => []
            ]
        );

        $contactAttribute = $this->mockedClient->contactAttributes->create('henkie_name', 'henkie_label', 'license_plate');

        $this->assertEquals("henkie_name", $contactAttribute->getName());
        $this->assertEquals("henkie_label", $contactAttribute->getLabel());
        $this->assertEquals("license_plate", $contactAttribute->getType());
        $this->assertEquals("henkie_description", $contactAttribute->getDescription());
        $this->assertEquals([], $contactAttribute->getOptions());

    }

    /** @test
     * @throws PiggyRequestException
     */
    public function it_creates_a_multi_select_contact_attribute()
    {

        $this->addExpectedResponse(
            [
                "name" => "pietje_name",
                "label" => "pietje_label",
                "type" => "multi_select",
                "description" => 'pietje_description',
                "options" =>
                    [
                        ["label" => "some_option_label", "value" => "3"],
                        ["label" => 'some_second_option_label', "value" => "4"]
                    ]
            ]
        );

        $contactAttribute = $this->mockedClient->contactAttributes->create('pietje_name', 'pietje_label', 'multi_select', 'pietje_description', [["label" => "some_option_label", "value" => "3"],["label" => 'some_second_option_label', "value" => "4"]]);

        $this->assertEquals("pietje_name", $contactAttribute->getName());
        $this->assertEquals("pietje_label", $contactAttribute->getLabel());
        $this->assertEquals("multi_select", $contactAttribute->getType());
        $this->assertEquals("pietje_description", $contactAttribute->getDescription());
        $this->assertEquals([["label" => "some_option_label", "value" => "3"],["label" => 'some_second_option_label', "value" => "4"]], $contactAttribute->getOptions());

    }

}