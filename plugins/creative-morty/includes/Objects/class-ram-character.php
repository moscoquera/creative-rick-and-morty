<?php


namespace Creative_Morty\Objects;


use GuzzleHttp\Client;

class RAM_character
{

    const POST_TYPE ='ram_character';
    const POST_TYPE_MENU_ICON='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTgiIGhlaWdodD0iNTkiIHZpZXdCb3g9IjAgMCA1OCA1OSIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE3LjY2MzMgMC4xMDE1NThDMTcuNDIyOSAwLjA5NjcyNDMgMTcuMjAwMiAwLjEyNzk5NiAxNyAwLjE5OTk5NkMxOC4yIDYuMiAxNyAxMi45OTIyIDE3IDEyLjk5MjJDMTcgMTIuOTkyMiA5LjggMTAuOTY0IDMuOCA5LjhDMy44IDE3LjkxMiAxMSAyMy40MTk1IDExIDIzLjQxOTVDMTEgMjMuNDE5NSAzLjggMjQuNTg0OCAwLjE5OTk5NyAyOC4wNjQ4QzUgMzEuNTMyOCA4LjYgMzEuNTMyOSA5LjggMzMuODYwOUM2LjQxNiAzNy4xNDg5IDEuNCAzOS44IDEuNCAzOS44TDExIDQxLjk3MjdDMTEgNDEuOTcyNyA5LjggNDUuOTY4IDcuNCA1MC42QzEwLjM5OCA1MC42IDE0LjA2MzcgNDkuODA0OSAxNS4yNjA5IDQ5LjUyNjZDMTcuODgwNCA1NS4xMzgxIDIzLjAxMDIgNTkgMjkgNTlDMzQuOTc3OSA1OSA0MC4wOTg1IDU1LjE1MjggNDIuNzIyNyA0OS41NTk0QzQzLjc5NTcgNDkuODc0OCA0Ni41NjA2IDUwLjYgNDkuNCA1MC42QzQ4LjIgNDcuMTIgNDcgNDEuOTcyNyA0NyA0MS45NzI3QzQ3IDQxLjk3MjcgNTYuMjc2IDQwLjEyNCA1Ni42IDM4LjZDNTMgMzYuMjg0IDQ5LjQgMzIuNjk2MSA0OS40IDMyLjY5NjFDNDkuNCAzMi42OTYxIDU1LjQgMjkuOTk2IDU3LjggMjQuMkM1MS44IDI0LjIgNDcgMjMuNDE5NSA0NyAyMy40MTk1QzQ3IDIzLjQxOTUgNTAuNiAxNS42MzIgNTQuMiAxMUM0OC4yIDkuODM2IDQxIDEyLjk5MjIgNDEgMTIuOTkyMkM0MSAxMi45OTIyIDM5LjggNS45OTYgMzkuOCAwLjE5OTk5NkMzNi41OTYgLTAuOTUyMDA0IDI5IDguMzQ2ODcgMjkgOC4zNDY4N0MyOSA4LjM0Njg3IDIxLjI2OTcgMC4xNzQwNjggMTcuNjYzMyAwLjEwMTU1OFpNMjkgMTQuNkMzNi4xOTU3IDE0LjYgNDIuMiAyMS40Nzc1IDQyLjIgMzAuMlY0MUM0Mi4yIDQ5LjcyMjUgMzYuMTk1NyA1Ni42IDI5IDU2LjZDMjEuODA0MyA1Ni42IDE1LjggNDkuNzIyNSAxNS44IDQxVjMwLjJDMTUuOCAyMS40Nzc1IDIxLjgwNDMgMTQuNiAyOSAxNC42Wk0xOS4zNTMxIDI0LjE4MzZDMTkuMDY4MyAyNC4xODQ0IDE4Ljc5MzEgMjQuMjg2NCAxOC41NzY2IDI0LjQ3MTVDMTguMzYwMSAyNC42NTY1IDE4LjIxNjUgMjQuOTEyNSAxOC4xNzE0IDI1LjE5MzdDMTguMTI2MyAyNS40NzQ5IDE4LjE4MjcgMjUuNzYzIDE4LjMzMDUgMjYuMDA2NUMxOC40NzgzIDI2LjI0OTkgMTguNzA3OCAyNi40MzI5IDE4Ljk3ODEgMjYuNTIyN0MxOC45NzgxIDI2LjUyMjcgMTkuODE2NiAyNi44MTU3IDIxLjMzODMgMjcuMTE4QzE5LjQ5NDggMjcuOTgwMSAxOC4yIDI5Ljg0MTMgMTguMiAzMkMxOC4yIDM0Ljk2ODEgMjAuNjMxOSAzNy40IDIzLjYgMzcuNEMyNi41NjgxIDM3LjQgMjkgMzQuOTY4MSAyOSAzMkMyOSAzMC4yNzEyIDI4LjE2MTQgMjguNzQxMSAyNi44ODU5IDI3Ljc1MDhDMjcuNTUzOCAyNy43ODA0IDI4LjI1MSAyNy44IDI5IDI3LjhDMjkuNzQ5IDI3LjggMzAuNDQ2MiAyNy43ODA0IDMxLjExNDEgMjcuNzUwOEMyOS44Mzg2IDI4Ljc0MTEgMjkgMzAuMjcxMiAyOSAzMkMyOSAzNC45NjgxIDMxLjQzMTkgMzcuNCAzNC40IDM3LjRDMzcuMzY4MSAzNy40IDM5LjggMzQuOTY4MSAzOS44IDMyQzM5LjggMjkuODQxMyAzOC41MDUyIDI3Ljk4MDEgMzYuNjYxNyAyNy4xMThDMzguMTgzNCAyNi44MTU3IDM5LjAyMTkgMjYuNTIyNyAzOS4wMjE5IDI2LjUyMjdDMzkuMjg4MyAyNi40MjcgMzkuNTEyMyAyNi4yNDA0IDM5LjY1NDQgMjUuOTk1NkMzOS43OTY1IDI1Ljc1MDggMzkuODQ3NSAyNS40NjM3IDM5Ljc5ODQgMjUuMTg1QzM5Ljc0OTMgMjQuOTA2MyAzOS42MDMzIDI0LjY1MzggMzkuMzg2MiAyNC40NzIzQzM5LjE2OTEgMjQuMjkwOCAzOC44OTQ3IDI0LjE5MTggMzguNjExNyAyNC4xOTNDMzguNDYzMiAyNC4xOTQgMzguMzE2MiAyNC4yMjI2IDM4LjE3ODEgMjQuMjc3M0MzOC4xNzgxIDI0LjI3NzMgMzUuMjQ5NiAyNS40IDI5IDI1LjRDMjIuNzUwNCAyNS40IDE5LjgyMTkgMjQuMjc3MyAxOS44MjE5IDI0LjI3NzNDMTkuNjczNSAyNC4yMTUgMTkuNTE0MSAyNC4xODMxIDE5LjM1MzEgMjQuMTgzNlpNMjMuNiAyOUMyNS4yNzExIDI5IDI2LjYgMzAuMzI4OSAyNi42IDMyQzI2LjYgMzMuNjcxMSAyNS4yNzExIDM1IDIzLjYgMzVDMjEuOTI4OSAzNSAyMC42IDMzLjY3MTEgMjAuNiAzMkMyMC42IDMwLjMyODkgMjEuOTI4OSAyOSAyMy42IDI5Wk0zNC40IDI5QzM2LjA3MTEgMjkgMzcuNCAzMC4zMjg5IDM3LjQgMzJDMzcuNCAzMy42NzExIDM2LjA3MTEgMzUgMzQuNCAzNUMzMi43Mjg5IDM1IDMxLjQgMzMuNjcxMSAzMS40IDMyQzMxLjQgMzAuMzI4OSAzMi43Mjg5IDI5IDM0LjQgMjlaTTM1IDMwLjJDMzQuNjgxNyAzMC4yIDM0LjM3NjUgMzAuMzI2NCAzNC4xNTE1IDMwLjU1MTVDMzMuOTI2NCAzMC43NzY1IDMzLjggMzEuMDgxNyAzMy44IDMxLjRDMzMuOCAzMS43MTgzIDMzLjkyNjQgMzIuMDIzNSAzNC4xNTE1IDMyLjI0ODVDMzQuMzc2NSAzMi40NzM2IDM0LjY4MTcgMzIuNiAzNSAzMi42QzM1LjMxODMgMzIuNiAzNS42MjM1IDMyLjQ3MzYgMzUuODQ4NSAzMi4yNDg1QzM2LjA3MzYgMzIuMDIzNSAzNi4yIDMxLjcxODMgMzYuMiAzMS40QzM2LjIgMzEuMDgxNyAzNi4wNzM2IDMwLjc3NjUgMzUuODQ4NSAzMC41NTE1QzM1LjYyMzUgMzAuMzI2NCAzNS4zMTgzIDMwLjIgMzUgMzAuMlpNMjMgMzEuNEMyMi42ODE3IDMxLjQgMjIuMzc2NSAzMS41MjY0IDIyLjE1MTUgMzEuNzUxNUMyMS45MjY0IDMxLjk3NjUgMjEuOCAzMi4yODE3IDIxLjggMzIuNkMyMS44IDMyLjkxODMgMjEuOTI2NCAzMy4yMjM1IDIyLjE1MTUgMzMuNDQ4NUMyMi4zNzY1IDMzLjY3MzYgMjIuNjgxNyAzMy44IDIzIDMzLjhDMjMuMzE4MyAzMy44IDIzLjYyMzUgMzMuNjczNiAyMy44NDg1IDMzLjQ0ODVDMjQuMDczNiAzMy4yMjM1IDI0LjIgMzIuOTE4MyAyNC4yIDMyLjZDMjQuMiAzMi4yODE3IDI0LjA3MzYgMzEuOTc2NSAyMy44NDg1IDMxLjc1MTVDMjMuNjIzNSAzMS41MjY0IDIzLjMxODMgMzEuNCAyMyAzMS40Wk0zMC4xODEyIDM3LjM4MzZDMjkuODYzNCAzNy4zODg2IDI5LjU2MDUgMzcuNTE5NCAyOS4zMzkgMzcuNzQ3NUMyOS4xMTc2IDM3Ljk3NTUgMjguOTk1NiAzOC4yODIxIDI5IDM4LjZWNDEuOTIzNEMyOSA0Mi4wNTUgMjguOTg3NSA0Mi4wNTA0IDI4Ljk3NjYgNDIuMTI3M0MyOC45MTg4IDQyLjExNDkgMjkuMDAyMyA0Mi4xMjM1IDI4LjkwMzkgNDIuMDc4MUMyOC4yODAzIDQxLjc5MDMgMjcuNDEzMyA0MS4wMzk4IDI3LjQxMzMgNDEuMDM5OEMyNy4yOTc4IDQwLjkzMDkgMjcuMTYxOCA0MC44NDU5IDI3LjAxMzMgNDAuNzg5OUMyNi44NjQ3IDQwLjczMzkgMjYuNzA2NSA0MC43MDc5IDI2LjU0NzggNDAuNzEzNEMyNi4zODkxIDQwLjcxOSAyNi4yMzMxIDQwLjc1NiAyNi4wODg5IDQwLjgyMjJDMjUuOTQ0NiA0MC44ODg1IDI1LjgxNDkgNDAuOTgyNyAyNS43MDczIDQxLjA5OTVDMjUuNTk5NyA0MS4yMTYyIDI1LjUxNjMgNDEuMzUzMiAyNS40NjIgNDEuNTAyNEMyNS40MDc3IDQxLjY1MTYgMjUuMzgzNSA0MS44MTAxIDI1LjM5MDkgNDEuOTY4N0MyNS4zOTgzIDQyLjEyNzMgMjUuNDM3MSA0Mi4yODI4IDI1LjUwNSA0Mi40MjYzQzI1LjU3MyA0Mi41Njk4IDI1LjY2ODcgNDIuNjk4NCAyNS43ODY3IDQyLjgwNDdDMjUuNzg2NyA0Mi44MDQ3IDI2LjcxOTcgNDMuNzE0OSAyNy44OTYxIDQ0LjI1NzhDMjguNDg0MyA0NC41MjkzIDI5LjI1MTIgNDQuODI1NyAzMC4xNDE0IDQ0LjQxNDhDMzAuNTg2NSA0NC4yMDk0IDMwLjk1NTYgNDMuNzk0NSAzMS4xNDY5IDQzLjM1MzFDMzEuMzM4MiA0Mi45MTE3IDMxLjQgNDIuNDQ3MSAzMS40IDQxLjkyMzRWMzguNkMzMS40MDIyIDM4LjQzOTQgMzEuMzcyMiAzOC4yODAxIDMxLjMxMTcgMzguMTMxNEMzMS4yNTEyIDM3Ljk4MjYgMzEuMTYxNCAzNy44NDc2IDMxLjA0NzggMzcuNzM0MUMzMC45MzQxIDM3LjYyMDcgMzAuNzk4OSAzNy41MzEyIDMwLjY1IDM3LjQ3MUMzMC41MDEyIDM3LjQxMDggMzAuMzQxOCAzNy4zODExIDMwLjE4MTIgMzcuMzgzNlpNMjkgNDUuOEMyNCA0NS44IDIwLjIyMDMgNDcuMDYwOSAyMC4yMjAzIDQ3LjA2MDlDMjAuMDcwNyA0Ny4xMTA4IDE5LjkzMjQgNDcuMTg5NiAxOS44MTMyIDQ3LjI5MjlDMTkuNjk0MSA0Ny4zOTYyIDE5LjU5NjQgNDcuNTIyIDE5LjUyNTkgNDcuNjYzQzE5LjQ1NTMgNDcuODA0IDE5LjQxMzMgNDcuOTU3NiAxOS40MDIxIDQ4LjExNDlDMTkuMzkwOSA0OC4yNzIyIDE5LjQxMDggNDguNDMwMiAxOS40NjA3IDQ4LjU3OThDMTkuNTEwNSA0OC43Mjk0IDE5LjU4OTQgNDguODY3NyAxOS42OTI3IDQ4Ljk4NjhDMTkuNzk2MSA0OS4xMDU5IDE5LjkyMTggNDkuMjAzNiAyMC4wNjI5IDQ5LjI3NDFDMjAuMjA0IDQ5LjM0NDYgMjAuMzU3NSA0OS4zODY2IDIwLjUxNDggNDkuMzk3OEMyMC42NzIxIDQ5LjQwODkgMjAuODMwMSA0OS4zODkgMjAuOTc5NyA0OS4zMzkxQzIwLjk3OTcgNDkuMzM5MSAyMS4zNjI2IDQ5LjIyODMgMjEuOTEyNSA0OS4wODU5QzIxLjk2NjQgNDkuMzMxNSAyMi4wMzg5IDQ5LjU5NjEgMjIuMTYzMyA0OS44ODA1QzIyLjQ0MTUgNTAuNTE2NCAyMy4xNzMyIDUxLjExMjggMjQuMDg1MiA1MS40NjAyQzI0LjEyOTYgNTEuNzY5NCAyNC4wNzc2IDUxLjg1NjEgMjQuMjYzMyA1Mi4yODA1QzI0LjY0MzUgNTMuMTQ5NiAyNS42OTI5IDU0LjIgMjcuMiA1NC4yQzI4LjcwNzEgNTQuMiAyOS43NTY1IDUzLjE0OTYgMzAuMTM2NyA1Mi4yODA1QzMwLjMwODUgNTEuODg3NyAzMC4yNTMgNTEuODIwOCAzMC4zMDA4IDUxLjUyMTFDMzAuNTczNSA1MS40NTUyIDMwLjYyMjYgNTEuNTI3NSAzMC45NDUzIDUxLjM0M0MzMS43MjczIDUwLjg5NjEgMzIuNTA0OSA0OS44NTggMzIuNTgzNiA0OC40Mjk3QzM1LjI1NzYgNDguNzYxOCAzNy4wMjAzIDQ5LjMzOTEgMzcuMDIwMyA0OS4zMzkxQzM3LjE2OTkgNDkuMzg5IDM3LjMyNzkgNDkuNDA4OSAzNy40ODUyIDQ5LjM5NzhDMzcuNjQyNSA0OS4zODY2IDM3Ljc5NiA0OS4zNDQ2IDM3LjkzNzEgNDkuMjc0MUMzOC4wNzgyIDQ5LjIwMzYgMzguMjAzOSA0OS4xMDU5IDM4LjMwNzMgNDguOTg2OEMzOC40MTA2IDQ4Ljg2NzcgMzguNDg5NSA0OC43Mjk0IDM4LjUzOTMgNDguNTc5OEMzOC41ODkyIDQ4LjQzMDIgMzguNjA5MSA0OC4yNzIyIDM4LjU5NzkgNDguMTE0OUMzOC41ODY3IDQ3Ljk1NzYgMzguNTQ0NyA0Ny44MDQgMzguNDc0MSA0Ny42NjNDMzguNDAzNiA0Ny41MjIgMzguMzA1OSA0Ny4zOTYyIDM4LjE4NjggNDcuMjkyOUMzOC4wNjc2IDQ3LjE4OTYgMzcuOTI5MyA0Ny4xMTA4IDM3Ljc3OTcgNDcuMDYwOUMzNy43Nzk3IDQ3LjA2MDkgMzQgNDUuOCAyOSA0NS44Wk0yOSA0OC4yQzI5LjQxMzMgNDguMiAyOS44MDUxIDQ4LjIxODQgMzAuMTk3NyA0OC4yMzUyQzMwLjE5MDIgNDkuMDQ0MyAyOS45NzY2IDQ5LjEzMDIgMjkuNzU0NyA0OS4yNTdDMjkuNTI4OSA0OS4zODYxIDI5LjMgNDkuNCAyOS4zIDQ5LjRDMjguOTgxNyA0OS40IDI4LjY3NjUgNDkuNTI2NSAyOC40NTE1IDQ5Ljc1MTVDMjguMjI2NSA0OS45NzY1IDI4LjEgNTAuMjgxNyAyOC4xIDUwLjZDMjguMSA1MC42IDI4LjA4MyA1MC45ODg3IDI3LjkzODMgNTEuMzE5NUMyNy43OTM1IDUxLjY1MDQgMjcuNzkyOSA1MS44IDI3LjIgNTEuOEMyNi42MDcxIDUxLjggMjYuNjA2NSA1MS42NTA0IDI2LjQ2MTcgNTEuMzE5NUMyNi4zMTcgNTAuOTg4NyAyNi4zIDUwLjYgMjYuMyA1MC42QzI2LjMgNTAuMjgxNyAyNi4xNzM1IDQ5Ljk3NjUgMjUuOTQ4NSA0OS43NTE1QzI1LjcyMzUgNDkuNTI2NSAyNS40MTgyIDQ5LjQgMjUuMSA0OS40QzI0LjUwNzEgNDkuNCAyNC41MDY1IDQ5LjI1MDQgMjQuMzYxNyA0OC45MTk1QzI0LjMxMjYgNDguODA3MiAyNC4yOTQzIDQ4LjY5OTYgMjQuMjcwMyA0OC41OTE0QzI1LjU3OCA0OC4zNzc3IDI3LjE5MTQgNDguMiAyOSA0OC4yWiIgZmlsbD0iYmxhY2siLz4KPC9zdmc+Cgo=';

    public static function register(){

        register_post_type(
            RAM_character::POST_TYPE,
            array(
                'label'=>'Characters',
                'labels'=>array(
                    'name'=>'Characters',
                    'singular_name'=>'Character'
                ),
                'description'=>'Rick and Morty character',
                'public'=>true,
                'hierarchical'=>false,
                'exclude_from_search'=>false,
                'show_ui'=>true,
                'show_in_menu'=>true,
                'show_in_rest'=>true,
                'menu_position'=>6,
                'menu_icon'=>RAM_character::POST_TYPE_MENU_ICON,
                'supports'=>array('title'),
                'register_meta_box_cb'=>array(RAM_character::class,'register_post_meta_boxes'),
            )
        );

        //register character meta keys
        register_post_meta(self::POST_TYPE,'_ram_status',array(
            'type'=>'string',
            'description'=>'Character status',
            'single'=>true,
            'show_in_rest'=>true
        ));

        register_post_meta(self::POST_TYPE,'_ram_species',array(
            'type'=>'string',
            'description'=>'Character specie',
            'single'=>true,
            'show_in_rest'=>true
        ));

        register_post_meta(self::POST_TYPE,'_ram_type',array(
            'type'=>'string',
            'description'=>'Character type',
            'single'=>true,
            'show_in_rest'=>true
        ));

        register_post_meta(self::POST_TYPE,'_ram_gender',array(
            'type'=>'string',
            'description'=>'Character gender',
            'single'=>true,
            'show_in_rest'=>true
        ));

        register_post_meta(self::POST_TYPE,'_ram_origin',array(
            'type'=>'string',
            'description'=>'Character origin',
            'single'=>true,
            'show_in_rest'=>true
        ));

        register_post_meta(self::POST_TYPE,'_ram_location',array(
            'type'=>'string',
            'description'=>'Character location',
            'single'=>true,
            'show_in_rest'=>true
        ));

        register_post_meta(self::POST_TYPE,'_ram_image',array(
            'type'=>'string',
            'description'=>'Character image',
            'single'=>true,
            'show_in_rest'=>true
        ));

    }

    public static function register_post_meta_boxes(){
            //TODO: remove_meta_box() and add_meta_box()

    }

    public static function import($limit=10){
        $api_limit = min(20,$limit);
        $imported=0;
        $endpoint = RAM_API_URL.'character';

        $client = new Client();
        while($imported<$limit){
            $page=intval(ceil($imported/$api_limit));
            try {
                $response = $client->request('GET', $endpoint . "?page=$page");
            }
            catch(\Exception $exception){
                return 'API_ERROR';
            }
            if($response->getStatusCode()!=200){
                return 'API_ERROR';
            }
            $response_body = json_decode($response->getBody());
            $results = $response_body->results;


            foreach ($results as $result){
                if(self::convert_and_save($result)){
                    $imported++;
                }
            }

            if(sizeof($results)<$api_limit){
                break; //nothing more to grab
            }

        }
        return $imported;
    }

    public static function convert_and_save($api_object){
        $post_data=array();
        $post_data['post_title']=$api_object->name;
        $post_data['post_status']='publish';
        $post_data['post_type']=self::POST_TYPE;
        $post_data['meta_input']=array();

        $post_data['meta_input']['_ram_status']=$api_object->status;
        $post_data['meta_input']['_ram_species']=$api_object->species;
        $post_data['meta_input']['_ram_type']=$api_object->type;
        $post_data['meta_input']['_ram_gender']=$api_object->gender;
        $post_data['meta_input']['_ram_origin']=$api_object->origin?$api_object->origin->name:'';
        $post_data['meta_input']['_ram_location']=$api_object->location?$api_object->location->name:'';
        $post_data['meta_input']['_ram_image']=$api_object->image;

        return wp_insert_post($post_data);
    }

    public static function delete_all_posts(){
        global $wpdb;
        $wpdb->delete($wpdb->prefix.'posts',array('post_type'=>self::POST_TYPE));
        $wpdb->query("DELETE FROM {$wpdb->prefix}postmeta WHERE post_id NOT IN (SELECT id FROM {$wpdb->prefix}posts)");
        $wpdb->query("DELETE FROM {$wpdb->prefix}term_relationships WHERE object_id NOT IN (SELECT id FROM {$wpdb->prefix}posts)");

    }

    public static function admin_post_columns($columns){
        unset($columns['date']);
        $columns['title']='Name';
        $columns['_ram_status']='Status';
        $columns['_ram_species']='Specie';
        $columns['_ram_type']='Type';
        $columns['_ram_gender']='Gender';
        $columns['_ram_location']='Location';
        return $columns;
    }

    public static function admin_post_columns_handle($column,$post_id){
        if(strpos($column,'_ram')===0){
            $value= get_post_meta($post_id,$column,true);
            echo __($value,'creative-morty');
        }
    }

}