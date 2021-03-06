@app @entity @staff @edit
Feature: Edit staffs
  In order to edit staffs
  As a system identity
  I should be able to send api requests related to staffs

  Background:
    Given I am authenticated as the "system" identity

  @createSchema @loadFixtures
  Scenario: Edit a staff
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82" with body:
    """
    {
      "ownerUuid": "325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "325e1004-8516-4ca9-a4d3-d7505bd9a7fe"

  Scenario: Confirm the edited staff
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "325e1004-8516-4ca9-a4d3-d7505bd9a7fe"

  Scenario: Edit a staff's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82" with body:
    """
    {
      "id": 9999,
      "uuid": "280092c3-c72c-47d1-a2ca-c9447a9ae5af",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "06f8bb0b-45e3-46af-94c7-ff917f720c82"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  Scenario: Confirm the unedited staff
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "06f8bb0b-45e3-46af-94c7-ff917f720c82"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  @dropSchema
  Scenario: Edit a staff with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82" with body:
    """
    {
      "ownerUuid": "35ea3685-59f4-48df-908c-3a0e8b7ce426",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the response should be in JSON
