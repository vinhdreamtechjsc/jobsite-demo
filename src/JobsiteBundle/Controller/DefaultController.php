<?php

namespace JobsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ONGR\ElasticsearchDSL\Query;
use ONGR\ElasticsearchDSL\Filter;
use JobsiteBundle\Document\JobDocument;
use GuzzleHttp\Client;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JobsiteBundle:Default:index.html.twig', array('name' => 'Welcome JobSite Demo'));
    }

    public function importAction()
    {
        set_time_limit(0);
        //get from crawler
        $client = new Client([
            'base_uri' => 'https://api.import.io/store/data/7e2a3a17-4df1-49d3-a308-733c89139313/',

        ]);
        try {
            for($page=22;$page>=1;$page--) {
                $response = $client->get('_query', [
                    "query" => [
                        'input/webpage/url' => 'http://www.vietnamworks.com/it-software-jobs-i35-en/page-'.$page,
                        '_user' => '398319a4-83a7-442b-a0df-cd0d80d39339',
                        '_apikey' => '398319a483a7442ba0dfcd0d80d39339ebeb4ff15c7be6f8e55728c00b26fc2438e29e57cedb46b46b70dc981a4d287763b9d26df1efb75aeb4e37488790735d512c34f221f1e7cc69f374756bfdccf9',
                    ]
                ]);
                $data = json_decode($response->getBody()->getContents());
                $jobs = ($data->results);

                foreach($jobs as $job) {
                    $job = get_object_vars($job);
                    //start import to ES
                    $manager = $this->get("es.manager");
                    $jobDocument = new JobDocument();
                    $jobDocument->position = $job["jobtitletext_link/_text"];
                    $jobDocument->positionSuggest = $job["jobtitletext_link/_text"];
                    $jobDocument->description = $job["textgraycol_descriptions"];
                    $jobDocument->location = $job["jobinfotext_value_1"];
                    $jobDocument->category = "IT - Software";
                    $jobDocument->company = $job['name_value'];
                    $jobDocument->logo = !empty($job['colpushtext_image']) ? $job['colpushtext_image'] : '';
                    $jobDocument->type = $job['jobinfotext_value_2'];

                    $manager->persist($jobDocument); //adds to bulk container

                }
                $manager->commit(); //bulk data to index and flush
            }

        } catch (RequestException $e) {
            echo $e->getRequest();
            if ($e->hasResponse()) {
                echo $e->getResponse();
            }

        }

        die('Import done');
    }

    public function searchAction()
    {
        $manager = $this->get("es.manager");
        $repository = $manager->getRepository('JobsiteBundle:JobDocument');

        $search = $repository->createSearch();
        $search->setSize(50);
        $hasChild = new Filter\HasChildFilter('careerlevel', new Filter\TermFilter('type', 'foo'));
        $search->addFilter($hasChild);
        $queryStringQuery = new Query\QueryStringQuery("php", ["default_field"=>"position"]);

        $search->addQuery($queryStringQuery);


        var_dump($search->toArray());

        $results = $repository->execute($search);
        echo $results->count();
        echo "<pre>";

        foreach ($results as $job)
        {
            echo ($job->position." (".$job->company.")<br />");
        }

        die;
    }
}
