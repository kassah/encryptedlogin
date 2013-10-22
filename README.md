This is an attempt to make a wire-tap resistant login for regular HTTP logins.

This does not replace HTTPS, which is a third party verification of host as well as encrypting the entire message.

The only goal here is to prevent user/pass reveal to wire-taps, and to be resistant to replay attacks for cases where HTTPS is not practical.

This is STILL vulnerable to Man-in-the-middle attack and replay attacks made within 5 minutes.

You could fully eliminate replay attacks by providing one-time tokens to the browser, and on submission the token would be invalidated. If you did that, you could skip the IP and time check.

Hope this helps someone.

Thanks,
William Lightning