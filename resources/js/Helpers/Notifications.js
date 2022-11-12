class Notification {
    success()
    {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Done!',
            timeout:1000,
        }).show();

    };
    alert()
    {
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Are you sure?!',
            timeout:1000,
        }).show();

    };
    error()
    {
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'Something went wrong?!',
            timeout:1500,
        }).show();
    };
    warning()
    {
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'Oops Wrong!',
            timeout:1000,
        }).show();
    };
    Image_validation()
    {
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: 'Uploaded image big than 2MB!',
            timeout:1500,
        }).show();
    };
    exist()
    {
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'This Item is exist',
            timeout:1500,
        }).show();
    };


}
export default Notification = new Notification();
