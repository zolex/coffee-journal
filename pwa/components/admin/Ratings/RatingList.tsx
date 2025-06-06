import {ListGuesser, FieldGuesser} from "@api-platform/admin";
import React from "react";

export const RatingList = () => (
  <ListGuesser>
    <FieldGuesser source="name" />
    <FieldGuesser source="value" />
  </ListGuesser>
);
