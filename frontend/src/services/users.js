import { http } from './config';

export default {

    saveUser:(user)=>{
        return http.post('/users/create', user);
    },
    
    loginUser:(user)=>{
        return http.post('/auth/login', user);
    },
}