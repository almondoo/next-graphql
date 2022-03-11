import { gql } from '@apollo/client';
import type { Task } from 'models/task';

export const UPDATE_TASKS_QUERY = gql`
  query UpdateTask($input: CreateTaskInput!) {
    updateTask(input: $input) {
      id
      title
      text
    }
  }
`;

export interface TaskData {
  tasks: Task[];
}
