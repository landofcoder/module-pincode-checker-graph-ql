<?php
/**
 * Landofcoder
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Landofcoder
 * @package     Lof_PincodeCheckerGraphQl
 * @copyright   Copyright (c) Landofcoder (https://landofcoder.com/)
 * @license     https://landofcoder.com/LICENSE.txt
 */

declare(strict_types=1);

namespace Lof\PincodeCheckerGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Lof\PincodeChecker\Api\PincodecheckerRepositoryInterface;

/**
 * Class CheckPincode
 * @package Lof\PincodeCheckerGraphQl\Model\Resolver
 */
class CheckPincode implements ResolverInterface
{
    protected $_pincodecheckeRepository;
    /**
     * check pincode constructor.
     * @param PincodecheckerRepositoryInterface $pincodecheckeRepositoryInterface
     */
    public function __construct(
        PincodecheckerRepositoryInterface $pincodecheckeRepositoryInterface
    ) {
        $this->_pincodecheckeRepository = $pincodecheckeRepositoryInterface;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $this->validateArgs($args);
        $result = $this->_pincodecheckeRepository->checkPincode($args['input']['sku'],$args['input']['pincode']);
        return $result;
    }
    /**
     * @param array $args
     *
     * @throws GraphQlInputException
     */
    public function validateArgs($args)
    {
        if (!isset($args['input'])) {
            throw new GraphQlInputException(__('Required parameter "input" is missing'));
        }
        
        if (!isset($args['input']['sku'])) {
            throw new GraphQlInputException(__('Required parameter "sku" is missing'));
        }

        if (!isset($args['input']['pincode'])) {
            throw new GraphQlInputException(__('Required parameter "pincode" is missing'));
        }
    }
}
