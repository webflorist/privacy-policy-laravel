<?php

namespace Webflorist\PrivacyPolicy;

/**
 * Class PrivacyPolicy
 * @package Webflorist\PrivacyPolicy
 */
class PrivacyPolicy
{

    private array $allProcessors = [];

    private array $interpolations = [];

    private array $usedProcessors = [];

    /**
     * PrivacyPolicy constructor.
     */
    public function __construct()
    {
        $this->allProcessors = array_merge(config('privacy-policy.processors'), \Webflorist\PrivacyPolicyText\Helpers::getProcessors());


        // Determine used processors and interpolations for translation
        foreach (config('privacy-policy.data_processing') as $processType => $process) {
            $processors = is_array($process['processor']) ? $process['processor'] : [$process['processor']];

            // Create interpolations for translation of texts.
            $processorLinks = [];
            foreach ($processors as $processorKey) {
                if (!isset($this->allProcessors[$processorKey])) {
                    throw new \Webflorist\PrivacyPolicy\Exceptions\ProcessorNotFoundException("Processor '$processorKey' used for data-processing '$processType' not found in processor-list. Please state processor details via the config key 'privacy-policy.processors'.");
                }
                $processorName = $this->allProcessors[$processorKey]['name'];
                $processorLinks[] = '<a href="#processor-' . $processorKey . '">' . $processorName . '</a>';
            }
            $this->interpolations[$processType . '_processor'] = implode(', ', $processorLinks);
            $this->interpolations[$processType . '_service'] = $process['service'] ?? __("Webflorist-PrivacyPolicy::privacy-policy.data_processing.$processType.title");

            // Put processors in $this->usedProcessors
            foreach ($processors as $processorKey) {
                if (!isset($this->usedProcessors[$processorKey])) {
                    $this->usedProcessors[$processorKey] = $this->allProcessors[$processorKey];
                }

                // Add data purpose to processor.
                if (!isset($this->usedProcessors[$processorKey]['purposes'])) {
                    $this->usedProcessors[$processorKey]['purposes'] = [];
                }
                if (!in_array($processType, $this->usedProcessors[$processorKey]['purposes'])) {
                    $this->usedProcessors[$processorKey]['purposes'][] = $processType;
                }

                // Add data categories to processor.
                if (!isset($this->usedProcessors[$processorKey]['data_categories'])) {
                    $this->usedProcessors[$processorKey]['data_categories'] = [];
                }
                $this->usedProcessors[$processorKey]['data_categories'] = array_unique(array_merge($this->usedProcessors[$processorKey]['data_categories'], $process['data_categories']));
            }
        }
    }

    public function getUsedProcessors() {
        return $this->usedProcessors;
    }

    public function translate(string $key)
    {
        return \Webflorist\PrivacyPolicyText\Helpers::renderText(__("Webflorist-PrivacyPolicy::privacy-policy.$key", $this->interpolations));
    }
}
