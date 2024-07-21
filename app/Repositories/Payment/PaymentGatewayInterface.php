<?php
namespace App\Repositories\Payment;

/**
 * Interface PaymentGatewayInterface
 * @package App\Repositories\Payment
 */
interface PaymentGatewayInterface
{
    /**
     * Pay a specified amount.
     *
     * @param float $amount The amount to pay.
     * @param string $return_url The URL to return to after payment.
     * @param int|string $purchase_order_id The purchase order ID.
     * @param string $purchase_order_name The purchase order name.
     * @return mixed
     */
    public function pay(float $amount, string $return_url, $purchase_order_id, string $purchase_order_name);

    /**
     * Initiate a payment process.
     *
     * @param float $amount The amount to initiate.
     * @param string $return_url The URL to return to after initiation.
     * @param array|null $arguments Additional arguments for initiation.
     * @return mixed
     */
    public function initiate(float $amount, string $return_url, ?array $arguments = null);

    /**
     * Inquire about a transaction.
     *
     * @param mixed $transaction_id The transaction ID.
     * @param array|null $arguments Additional arguments for inquiry.
     * @return array The inquiry result.
     */
    public function inquiry($transaction_id, ?array $arguments = null) : array;

    /**
     * Check if the inquiry was successful.
     *
     * @param array $inquiry The inquiry result.
     * @param array|null $arguments Additional arguments for success check.
     * @return bool True if successful, false otherwise.
     */
    public function isSuccess(array $inquiry, ?array $arguments = null) : bool;

    /**
     * Get the requested amount from an inquiry.
     *
     * @param array $inquiry The inquiry result.
     * @param array|null $arguments Additional arguments for amount retrieval.
     * @return float The requested amount.
     */
    public function requestedAmount(array $inquiry, ?array $arguments = null) : float;
}
