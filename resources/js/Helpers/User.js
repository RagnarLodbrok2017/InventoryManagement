import Token from './Token';
import AppStorage from './AppStorage';

class User {

    responeAfterLogin(res)
    {
        const access_token = res.data.access_token;
        const username = res.data.name;
        if(Token.isValid(access_token))
        {
            AppStorage.store(access_token, username);
        }
        else{
            console.log("Invalid access token");
        }
    }


    hasToken()
    {
        const storeToken = AppStorage.getToken();
        if(storeToken)
        {
            return Token.isValid(storeToken)? true : false;
        }
        else
        {
            return false;
        }
    }
    loggedIn()
    {
        this.hasToken();
    }
    getName()
    {
        if(this.loggedIn())
        {
            return AppStorage.getUser();
        }
    }


}
export default User = new User();