<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyRepositoryTest extends TestCase
{
    protected $companyRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->companyRepository = new CompanyRepository();
    }

    public function test_can_create_company()
    {
        $companyData = [
            'name' => 'Test Company',
            'email' => 'test@example.com',
            // Add other required fields
        ];

        $createdCompany = $this->companyRepository->create($companyData);

        $this->assertInstanceOf(Company::class, $createdCompany);
        $this->assertDatabaseHas('companies', $companyData);
    }

    public function test_can_find_company()
    {
        $companyId = 1; // Assuming a company with ID 1 exists

        $foundCompany = $this->companyRepository->find($companyId);

        $this->assertInstanceOf(Company::class, $foundCompany);
        $this->assertEquals($companyId, $foundCompany->id);
    }

    public function test_can_update_company()
    {
        $companyId = 1; // Assuming a company with ID 1 exists

        $updatedData = [
            'name' => 'Updated Company Name',
        ];

        $updatedCompany = $this->companyRepository->update($companyId, $updatedData);

        $this->assertInstanceOf(Company::class, $updatedCompany);
        $this->assertDatabaseHas('companies', $updatedData);
    }

    public function test_can_delete_company()
    {
        $companyId = 1; // Assuming a company with ID 1 exists

        $result = $this->companyRepository->delete($companyId);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('companies', ['id' => $companyId]);
    }
    public function testBasicTest()
    {
        $response = $this->get('/home'); // Change this route to the expected redirect route
        $response->assertStatus(302); // Update the assertion to 302 as it's a redirect
    }
}


