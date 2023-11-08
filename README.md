##Mak
/register{
    get: csrf,
    post: csrf
        [
           mobile : input,
           password : input,
           password-confirmation : input, 
        ],
};
/profile{
    get: csrf
    [
        user-name : db,
        mobile : db,
        gender : db,
        user-tickets:
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
                        english-name : db,
                        birth-date : db,
                        meli-code : db,
                    ]
                ],
            ],
        ],
    ]
};
/login{
    get: csrf
    post: csrf{
        mobile : input,
        password : input,
    }
}
/logout{
    post: csrf
}
profile/'user-id'{
    put:
    delete:
}