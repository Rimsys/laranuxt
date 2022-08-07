<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddDefaultPortfolioInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $skills = [
            [
                'name' => 'Php(Laravel)',
                'strength' => 95,
            ],
            [
                'name' => 'Php(Lumen)',
                'strength' => 90,
            ],
            [
                'name' => 'Node.js',
                'strength' => 95,
            ],
            [
                'name' => 'Typescript',
                'strength' => 90,
            ],
            [
                'name' => 'C#(asp.net core)',
                'strength' => 90,
            ],
            [
                'name' => 'TypeORM',
                'strength' => 80,
            ],
            [
                'name' => 'VueJS',
                'strength' => 90,
            ],
            [
                'name' => 'ReactJS',
                'strength' => 90,
            ],
            [
                'name' => 'MongoDB',
                'strength' => 96,
            ],
            [
                'name' => 'MySQL',
                'strength' => 96,
            ],
            [
                'name' => 'PostgreSQL',
                'strength' => 96,
            ],
            [
                'name' => 'Docker',
                'strength' => 90,
            ],
            [
                'name' => 'Git',
                'strength' => 96,
            ],
            [
                'name' => 'AWS',
                'strength' => 80,
            ],
        ];

        $expereinces = [
            [
                'company_name' => 'PATRICIA TECHNOLOGIES LIMITED',
                'position' => 'Senior Software Engineer',
                'responsibilities' => json_encode([
                    ' I implemented an authentication client that manages clients and client keys (NPM Package) that is used across Products in the company',
                    ' I integrated crypto services into the system, leveraging services like (bitgo, thresh0ld) and a custom Rate service',
                    ' I Created an architecture that helps Patricia customers perform sell and buy crypto services, and create Blockchain wallets by levering on Hierarchical Deterministic (HD) Wallets Architecture.',
                    ' I implemented Worked on Patricia Payment, leveraging on Paystack payment solution and other banks gateways',
                    ' I implemented a wallet system (Fiat wallet, Crypto Wallet) leveraging Microservices Approach',
                    ' I built Patricia International (E-commerce Web App) that facilitates trading of giftcards',
                    ' Lead a Team where we built and managed Bills payments (Airtime, Data, TV/Cable and Electricity subscription).',
                ], true),
                'start_date' => '2019-06-14',
                'is_current_position' => 1,
            ],
            [
                'company_name' => 'NETPLUSDOTCOM',
                'position' => 'Mid Software Engineer',
                'responsibilities' => json_encode([
                    'I built a consumable web service to facilitate payment.',
                    'I built And Consuming Web services from Payment gateway solutions like (Interswitch, Visa, MasterCard, GtBank (Gt pay ), Nibbs payment ) that rides on thepayment services',
                    'Created Real Estate applications that helps manage, bills payment, and electricity tokens which helps in the ease and management of Residents day to day life.',
                    'Developed Front End Development (NetPlusPay.com)',
                    'Effectively addressed complex bugs.',
                    'Implemented and updated application modules.'
                ], true),
                'start_date' => '2018-07-07',
                'end_date' => '2019-07-01',
            ],

            [
                'company_name' => 'MUTUAL BENEFITS MICROFINANCE BANK',
                'position' => 'Software Engineer',
                'responsibilities' => json_encode([
                    'Database Administrator (Microsoft SQL) Addressing Script issues',
                    'Implemented payment gateways in web applications',
                    'Asp.net building Banks website',
                    'Unit Testing and Debugging banks Application',
                    'Unit Testing and Debugging banks Application and adding features based on
                    customer requests.',
                    'Developed and implemented the web applications, based on .NET applications.',
                    'Ensure databases operate smoothly and efficiently and fix errors or problems that may occur',
                ], true),
                'start_date' => '2017-01-13',
                'end_date' => '2018-05-01',
            ],
        ];

        $biodata = [
            'first_name' => 'Ayorinde',
            'last_name' => 'Akindemowo',
            'email' => 'ayorinde223@gmail.com',
            'location' => 'Lagos, Nigeria',
            'headline' => 'Senior Software Engineer',
            'professional_summary' =>  'I am a versatile, resourceful, result-oriented software enthusiast with 5+ years of work experience building commercial software products using modern web technologies. I have successfully launched full applications in different niches including but not limited to e-commerce,medicine, Fintech, Real Estate etc. So I understand how to effectively contribute to the entire product development lifecycle. My passion for technology extends beyond basic development and into the realm of research and contributing to the cutting edge of web 3.0.',
            'myvalues' => 'I have experience using PHP for as long as I’ve been programming - 5+ years, and I follow the latest trends in the ecosystem and write software following the language’s standard recommendations (PSRs). I have used PHP, Laravel, MySQL, Nodejs, TypeScript, Reactjs, and Asp.net. to build production-ready applications.
            In my current position as Team Lead at Patricia, I make use of these technologies in developing new features and maintaining existing functionalities on the software. I have knowledge of the Agile processes and use this in the delivery of the new features and bug fixes as needed.
            On a daily basis, I require little to no assistance in getting my tickets completed. I like to work within a transparent organization and one where free communication is encouraged - with this in place, I am able to communicate freely with teammates and my manager without hassles and it is more productive and healthy.
            I have a “take-charge” attitude and as such take ownership of my domain and also not afraid to dig into old work that is not mine to add enhancements to them as necessary.
            My current toolbelt for development includes the following tools & platforms: PHP, Laravel, PHPUnit, NodeJS, Typescript, Jest, Nestjs, Docker, REST, Aws, Git, CI/CD, GitHub, Jira/Trello.
            I am happy to discuss further if you find me a good fit for the position. I look forward to receiving your response.',
            'github_url' => 'https://github.com/Ayorinde-Codes',
            'linkedin_url' => 'https://www.linkedin.com/in/ayorinde-akindemowo-530318149',
            'interests' => json_encode([
                'Software Development', 'soccer', 'music',
            ], true),
            'image' => 'https://www.ayorindea.com/assets/images/AyorindeA.jpg',
        ];

        DB::table('biodata')->insert($biodata);
        DB::table('skills')->insert($skills);
        foreach ($expereinces as $key => $value) {
            DB::table('experiencies')->insert($value);
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
