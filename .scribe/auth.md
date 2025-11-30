# Authenticating requests

To authenticate requests, include an **`Authorization`** header with the value **`"Bearer {YOUR_AUTH_TOKEN}"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

Use the <b>POST /login</b> endpoint to obtain your authentication token. Include the token in the Authorization header as <b>Bearer {token}</b> for all protected endpoints.
