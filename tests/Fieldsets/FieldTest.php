<?php

beforeEach(function () {
    $this->message = "You must call Carbon_Fields\Carbon_Fields::boot() in a suitable WordPress hook before using Carbon Fields.";
});

describe("image field", function () {
    it("should throw an third party Exception", function () {
        expect(function () {
            \Kirinaki\Framework\Fieldsets\Field::image("test", "Test");
        })->toThrow(Exception::class, $this->message);
    });
});

describe("text field", function () {
    it("should throw an third party Exception", function () {
        expect(function () {
            \Kirinaki\Framework\Fieldsets\Field::text("test", "Test");
        })->toThrow(Exception::class, $this->message);
    });
});

describe("textarea field", function () {
    it("should throw an third party Exception", function () {
        expect(function () {
            \Kirinaki\Framework\Fieldsets\Field::textarea("test", "Test");
        })->toThrow(Exception::class, $this->message);
    });
});

describe("richText field", function () {
    it("should throw an third party Exception", function () {
        expect(function () {
            \Kirinaki\Framework\Fieldsets\Field::richText("test", "Test");
        })->toThrow(Exception::class, $this->message);
    });
});

describe("complex field", function () {
    it("should throw an third party Exception", function () {
        expect(function () {
            \Kirinaki\Framework\Fieldsets\Field::complex("test", "Test");
        })->toThrow(Exception::class, $this->message);
    });
});