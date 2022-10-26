<?php

    /**
     * Same as the base exception class. This is just used to differentiate
     * between exceptions caused by PHP or MySQL, and errors thrown by me.
     *
     * Make sure when throwing a CustomException, the code is set to the HTTP
     * status code that corresponds to the error.
     */
    class CustomException extends Exception {
    }

    /**
     * Cleans the output buffer, creates an error page based on the exception,
     * and sends the page to the client by flushing the output buffer. It then
     * ends output buffering.
     */
    function exception_handler(Throwable $exception) {
        // Clear the output buffer (since there was an error, we do not want to
        // display the output that was generated)
        if (ob_get_contents()) {
            ob_clean();
        }

        // If the exception was a custom exception, then its error code will be
        // the HTTP status code that it corresponds to.
        if (get_class($exception) == 'CustomException') {
            $page_info = [
                'error' => true,
                'title' => 'Error ' . $exception->getCode(),
                'path_to_php_file' => __DIR__ . '/pages/errors/error' . $exception->getCode() . '.php',
                'message' => $exception->getMessage()
            ];

            http_response_code($exception->getCode());
        } else {
            // If the exception was not a custom exception, then it was thrown
            // by PHP or MySQL, so we can just say it is an HTTP status 500 error.
            $page_info = [
                'error' => true,
                'title' => 'Error 500',
                'path_to_php_file' => __DIR__ . '/pages/errors/error500.php',
                'message' => 'There was an error within the server. This one\'s on our end.'
            ];

            http_response_code(500);
        }

        // Create page
        require __DIR__ . '/page.php';

        // Send the output buffer (and stop output buffering)
        if (ob_get_contents()) {
            ob_end_flush();
        }
    }
?>
