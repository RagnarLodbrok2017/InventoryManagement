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
    getToken()
    {
        return AppStorage.getToken();

    }
    loggedIn()
    {
        return this.hasToken();
    }
    getName()
    {
        if(this.loggedIn())
        {
            return AppStorage.getUser();
        }
    }
    logout()
    {
        return AppStorage.clear();
    }
    isAuthenticated()
    {
        if (!this.loggedIn()) {
            return true;
        }
        else{
            return false;
        }


    }


}
export default User = new User();
