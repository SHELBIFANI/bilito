##Mak


/register{
    get: csrf,
    post: csrf
        [
           mobile : input,
           password : input,
           password_confirmation : input, 
        ],
};
/profile/tickets{
    get: csrf
    [
        user_tickets:
        [
            ticket:
            [
                flight:
                [
                    datas ...
                ],
                passengers:
                [
                    [
                        name : db,
                        lastname : db,
                        birth_date : db,
                        national_code : db,
                        gender :
                    ]
                ],
            ],
        ],
    ]
};
/profile/user_id get{
        user_name : db,
        mobile : db,
        gender : db,
        national_code :db,
        iamge_address :db,
}
/profile/"user_id"/edit get{
        user_name : db,
        mobile : db,
        gender : db,
        national_code db,
        iamge_address :db,
}

profile/'user_id'{
    post:{
    _method : put/patch
    mobile : input,
    national_code : input,
    gender : input,
    image : input_file
    password : input
    }

}

/login{
    get: csrf
    post: csrf{
        X-XSRF-TOKEN 
        mobile : input,
        password : input,
    }
}
/logout{
    post: csrf
}


GET             /

POST            /login
POST            /register
POST            /logout

GET             /profile/{user}
PUT|PATCH       /profile/{user}
GET|HEAD        /profile/{user}/edit

// GET             /tickets?origin='input'&destination='input'&departure='input'&passengers='input'
