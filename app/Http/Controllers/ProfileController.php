<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $data = [
            'name' => 'Philip Bissiwu',
            'email' => 'philipvibrant001@gmail.com',
            'phone' => '3029221589',
            'bio' => 'As a DevOps engineer with 6 years of experience, I am an expert in the implementation of Continuous Integration and Continuous Delivery (CI/CD) practices to streamline software development, testing, and deployment processes. I have extensive knowledge of AWS, Kubernetes, Docker, Ansible, Jenkins, CircleCI, and other related tools and technologies.

In my previous roles, I have designed and implemented CI/CD pipelines, optimized infrastructure for efficiency and scalability, and ensured the smooth operation of complex distributed systems. I have experience with scripting languages like Python and Bash, as well as with infrastructure-as-code tools such as Terraform and CloudFormation.

I have also collaborated closely with development and operations teams to improve collaboration and increase the speed and reliability of deployments. My excellent communication and problem-solving skills have allowed me to provide effective technical guidance and support to stakeholders at all levels.

Overall, my technical expertise in DevOps, combined with my collaborative and solution-oriented mindset, make me a valuable asset to any organization seeking to optimize their software development and delivery processes.
',
            'educationWorkHistory' => [
                'Master of Science Degree - Delaware State University',
                'DevOps Engineer - Thoroughcare March 2021 to present',
                'DevOps Engineer - Sidecar December 2019 to March 2021',
            ],
            'skills' => [
                'Automation: As a DevOps engineers I have an expertise  in automation tools and technologies, including scripting languages such as Python, Bash, as well as infrastructure-as-code tools like Terraform.',
                'CI/CD: I have a deep understanding of Continuous Integration and Continuous Delivery (CI/CD) methodologies and practices to optimize software delivery pipelines and ensure fast and reliable deployments. Jenkins, Circleci are tools I have used mostly.',
                'Cloud Computing: I am well versed in cloud computing technologies, including AWS, and Google Cloud Platform, to design and deploy scalable and efficient cloud-based infrastructure.',
                'Containerization: I have expertise in containerization technologies, such as Docker and Kubernetes, to package and deploy applications in a standardized and portable way.',
                'Configuration Management: I have knowledge and experience  in configuration management tools, such as Ansible to automate the setup and management of infrastructure.',
                'Monitoring and Logging: I am proficient in monitoring and logging tools, such as Prometheus, Grafana, to ensure the visibility and health of distributed systems.',
                'Collaboration and Communication: As a DevOps engineers I  have excellent communication and collaboration skills to work effectively with cross-functional teams and stakeholders at all levels.',
                'Problem-Solving: As a DevOps engineers I  have a strong problem-solving mindset to troubleshoot complex issues and find effective solutions in a timely manner.',
                'Continuous Learning: As a DevOps engineers I have a passion for continuous learning and keeping up-to-date with the latest technologies and trends in the DevOps space.',
            ],
        ];

        return view('profile', $data);
    }
}
