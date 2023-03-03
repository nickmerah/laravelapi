<?php

namespace Tests\Feature;
use App\Models\ContactForm;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    private $createMsg;

  

    public function setUp() :void
    {
        parent::setUp();
        $file = UploadedFile::fake()->create('audio.csv');
        $this->createMsg = ContactForm::create([
            'name' => 'Solomon Lar',
            'email' => 'tester@yahoo.com',
            'message' => 'Testing the API',
            'attachment' => $file
        ]);

        
    }
    public function test_get_all_contact_details()
    {
        $this->withoutMiddleware();
        $this->json('GET', 'api/msg')
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_create_message()
    {
        $this->withoutMiddleware();
        $file = UploadedFile::fake()->create('audio.csv');
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', 'api/msg', [
            'name' => 'Moses Lar',
            'email' => 'moses@yahoo.com',
            'message' => 'Creating a Message',
            'attachment' => $file
        
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_check_validation()
    {
        $this->withoutMiddleware();
        
        /***
         * email was wrongly formed
         * no attachments
         * message field was removed
         */
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', 'api/msg', [
            'name' => 'Solomon Lar',
            'email' => 'tester',
            'attachment' => "myfile.csv"
        
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }


    }
 

     

     
 